<?php

namespace App\Http\Controllers;

use App\Allocation;
use App\Comment;
use App\Project;
use App\Task;
use App\TaskWorking;
use App\Task_Allocation;
use App\Task_Media;
use App\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Storage;

class TaskController extends Controller
{

    public function all_Tasks($projectID)
    {
        $project = Project::find($projectID);

        // checking weather current client has access to that specific task or not
        if (Auth::User()->id != $project->client_id) {
            return back();
        }

        $tasks = Task::where('project_id', '=', $projectID)->orderBy('is_completed', 'asc')->get();
        $isAllocated = Allocation::where([['client_id', '=', Auth::user()->id], ['is_activated', '=', '1']])->get()->isEmpty();
        $resources = Allocation::where([['client_id', '=', Auth::user()->id], ['is_activated', '=', 1]])->get();
        $currentDate = date('Y-m-d');
        return view('tasks')
            ->with('tasks', $tasks)
            ->with('resources', $resources)
            ->with('currentDate', $currentDate)
            ->with('isAllocated', $isAllocated)
            ->with('project', $project);
    }

    public function viewAllTasks($projectID) //for Admin

    {
        $project = Project::find($projectID);

        // checking weather current client has access to that specific task or not
        $taskdetail = array();
        $tasks = Task::where('project_id', '=', $projectID)->orderBy('is_completed', 'asc')->get();
        $isAllocated = Allocation::where([['client_id', '=', Auth::user()->id], ['is_activated', '=', '1']])->get()->isEmpty();
        $resources = Allocation::where([['client_id', '=', Auth::user()->id], ['is_activated', '=', 1]])->get();
        $currentDate = date('Y-m-d');

        foreach ($tasks as $task) {
            $singletask = array();
            $singletask['task'] = $task;
            $timeforTask = 0;
            $taskWorking = TaskWorking::where([['task_id', '=', $task->id], ['is_break', '=', 0]])->orderBy('task_id', 'asc')->get();
            foreach ($taskWorking as $day) {
                if (isset($day->end)) {
                    $start = $day->start;
                    $end = $day->end;
                    $start_time = strtotime($start);
                    $end_time = strtotime($end);
                    $diff = $end_time - $start_time;
                    //return 'Diff: '.date('H:i:s', $diff);
                    $breaks = TaskWorking::where([['task_id', '=', $task->id], ['is_break', '=', 1], ['day', '=', $day->day]])->orderBy('id', 'asc')->get();
                    $countHours = 0;
                    foreach ($breaks as $break) {
                        $start = $break->start;
                        $end = $break->end;
                        $start_time = strtotime($start);
                        $end_time = strtotime($end);
                        $countHours += $end_time - $start_time;
                    }
                    $diff -= $countHours;
                    $timeforTask += $diff;
                }
            }
            $singletask['timeforTask'] = date('H:i:s', $timeforTask);
            array_push($taskdetail, $singletask);

        }
        // return $taskdetail;
        return view('allTasksHR')
            ->with('tasks', $tasks)
            ->with('resources', $resources)
            ->with('currentDate', $currentDate)
            ->with('isAllocated', $isAllocated)
            ->with('taskdetail', $taskdetail)
            ->with('project', $project);
    }

    public function addNewTask(Request $request)
    {
        $this->validate($request, [
            'description' => 'required|max:255',
            'cm_id' => 'required',
            'title' => 'required',
        ]);

        // checking weather current client has access to that specific project or not
        $project = Project::find($request->project_id);
        if (Auth::User()->id != $project->client_id) {
            return back();
        }

        // checking weather current client has access to that specific CM or not
        $resources_allocation = Allocation::where('cm_id', '=', $request->cm_id)
            ->where('client_id', '=', Auth::User()->id)
            ->count();
        if ($resources_allocation == 0) {
            return back();
        }

        //Create New task
        $task = new Task();
        $task_allocation = new Task_Allocation();
        $task->title = $request->title;
        $task->description = $request->description;
        $task->project_id = $request->project_id;
        $task->is_completed = 0;
        $task->start = date('Y-m-d H:i:s');
        $task->save();
        //Fill Data to Task Allocation Table according to TASK & PROJECT
        $task_allocation->cm_id = $request->cm_id;
        $task_allocation->task_id = $task->id;
        $task_allocation->assigned_date = date('Y-m-d H:i:s');
        $task_allocation->save();
        //FILL the data date that relevent to MEDIA Regarding the TASK AND PROJECT
        if ($request->has('file')) {
            foreach ($request->file as $file) {
                $task_media = new Task_Media();
                $uniquesavename = time() . uniqid(rand());
                $file_url = Storage::putFileAs('public/Files', $file, $uniquesavename . '-' . $file->getClientOriginalName());
                $fileName = $uniquesavename . '-' . $file->getClientOriginalName();
                $task_media->task_id = $task->id;
                $task_media->is_description = 0;
                $task_media->comment_id = 0;
                $task_media->file = $fileName;
                $task_media->created_at = date('Y-m-d H:i:s');
                $task_media->save();
            }
        }
        session()->flash('message', "Task Created And Allocated Successfully");
        return redirect("/client/all_Tasks/" . $request->project_id);
    }

// task details for CM
    public function tasksDetails($taskId)
    {

        // checking weather current client has access to that specific task or not
        $task_allocation = Task_Allocation::find($taskId);

        if (Auth::User()->Role->id == 2) {
            if (Auth::User()->id != $task_allocation->cm_id) {
                return back();
            }

        } else {
            if (Auth::User()->id != $task_allocation->Task->Project->client_id) {
                return back();
            }

        }

        $result = array();
        //task all details
        $tasks = Task::find($taskId);
        //show media related to tasks
        $taskMedia = Task_Media::where([['task_id', '=', $taskId], ['is_description', '=', 0]])->get();
        //files related to comments
        $taskMediaComment = Task_Media::where([['task_id', '=', $taskId], ['is_description', '=', 1]])->get();
        //task working to calculate time of a task
        $taskWorking = TaskWorking::where([['task_id', '=', $taskId], ['is_break', '=', 0]])->orderBy('day', 'asc')->get();
        $timeOntask = TaskWorking::where([['task_id', '=', $taskId], ['is_break', '=', 0]])->orderBy('day', 'asc')->WhereNull('end')->WhereNotNull('start')->first();
        $result['day'] = array();
        foreach ($taskWorking as $day) {
            if (isset($day->end)) { //means task has ended for given day
                $start = $day->start;
                $end = $day->end;
                $start_time = strtotime($start);
                $end_time = strtotime($end);
                $diff = $end_time - $start_time;
                //return 'Diff: '.date('H:i:s', $diff);
                $breaks = TaskWorking::where([['task_id', '=', $taskId], ['is_break', '=', 1], ['day', '=', $day->day]])->orderBy('id', 'asc')->get();
                $noOfBreaks = 0;
                $countHours = 0;
                foreach ($breaks as $break) {
                    $start = $break->start;
                    $end = $break->end;
                    $start_time = strtotime($start);
                    $end_time = strtotime($end);
                    $countHours += $end_time - $start_time;
                    $noOfBreaks++;
                }
                $diff -= $countHours;
                $day_detail = array(
                    "date" => $day->day,
                    "status" => true,
                    "workingHour" => date('H:i:s', $diff),
                    "noOfBreaks" => $noOfBreaks,
                );
                array_push($result['day'], $day_detail);
            } else {
                $day_detail = array(
                    "date" => $day->day,
                    "status" => false,
                    "workingHour" => 0,
                    "noOfBreaks" => 0,
                );
                array_push($result['day'], $day_detail);
            }
        }
        //last commet id to save in hidden field and use with ajax call
        $lastComment = Comment::where('task_id', $taskId)->orderBy('id', 'desc')->first();
        //all tasks comment to show on comment section
        $taskComment = Comment::where('task_id', $taskId)->get();
        //return $result;
        //use in app header
        $user = Auth::user();
        if (isset($lastComment)) {
            $lastCommentId = $lastComment->id;
        } else {
            $lastCommentId = 0;
        }
        return view('taskDetail')->
            with('tasks', $tasks)->
            with('timeOntask', $timeOntask)->
            with('user', $user)->
            with('taskMedia', $taskMedia)->
            with('taskMediaComment', $taskMediaComment)->
            with('lastComment', $lastCommentId)->
            with('result', $result)->
            with('taskComment', $taskComment);
    }

    public function addStartTime(Request $request)
    {
        $taskWorking = new TaskWorking();
        $taskWorking->task_id = $request->task_id;
        $taskWorking->day = date('Y-m-d');
        $taskWorking->is_break = $request->is_break;
        $taskWorking->start = date('H:i:s');
        $taskWorking->save();
        return Response::json(array(
            'success' => true,
            'msg' => 'Start Time noted Successfully.'));
    }
    public function addPauseTime(Request $request)
    {
        $taskWorking = new TaskWorking();
        $taskWorking->task_id = $request->task_id;
        $taskWorking->day = date('Y-m-d');
        $taskWorking->is_break = $request->is_break;
        $taskWorking->start = date('H:i:s');
        $taskWorking->save();
        return Response::json(array(
            'success' => true,
            'msg' => 'Paused Time noted Successfully.'));
    }
    public function addResumeTime(Request $request)
    {
        $taskWorking = TaskWorking::where('task_id', $request->task_id)->orderBy('id', 'desc')->limit(1);
        $taskWorking->update(array('end' => date('H:i:s')));
        return Response::json(array(
            'success' => true,
            'msg' => 'Resume Time noted Successfully.'));
    }
    public function addEndTime(Request $request)
    {
        $taskWorking = TaskWorking::where([['task_id', '=', $request->task_id], ['is_break', '=', 0]])->WhereNull('end');
        $taskWorking->update(array('end' => date('H:i:s')));
        return Response::json(array(
            'success' => true,
            'msg' => 'Resume Time noted Successfully.'));
    }

//on Client manager page load check previous status of Timer
    public function currentStatus(Request $request)
    {
        $taskWorking = TaskWorking::where([['task_id', '=', $request->task_id], ['is_break', '=', 0]])->WhereNull('end')->WhereNotNull('start')->get();
        if ($taskWorking->count() > 0) //means client manager has active active timer
        {
            $taskWorking = TaskWorking::where([['task_id', '=', $request->task_id], ['is_break', '=', 1]])->WhereNull('end')->WhereNotNull('start')->get();
            if ($taskWorking->count() > 0) //end time not null start time null
            {
                return Response::json(array(
                    'success' => true,
                    'msg' => '1')); //means cm is on break
            } else {
                return Response::json(array(
                    'success' => true,
                    'msg' => '2')); //means cm is not on break but in task
            }
        } else { //timer is not activated or work has done

            $taskWorking = TaskWorking::where([['task_id', '=', $request->task_id], ['is_break', '=', 0],['day','=',date('Y-m-d')]])->WhereNotNull('end')->WhereNotNull('start')->get();
            if ($taskWorking->count() > 0) {
                return Response::json(array(
                    'success' => true,
                    'msg' => '3')); //task has been already ended
            } else {
                return Response::json(array(
                    'success' => true,
                    'msg' => '4')); //task is not started or
            }

        }

    }

    public function CommentAjax(Request $request)
    {

        $tasks = Task::find($request->task_id);
        $taskMediaComment = Task_Media::where([['task_id', '=', $request->task_id], ['is_description', '=', 1]])->get();
        // return $request->lastRecode;
        $taskComment = Comment::where([['task_id', '=', $request->task_id], ['id', '>', $request->lastRecode]])->get();
        $result = view('comment')->with('taskMediaComment', $taskMediaComment)->with('tasks', $tasks)->with('taskComment', $taskComment)->render();
        $lastComment = Comment::where('task_id', $request->task_id)->orderBy('id', 'desc')->first();
        if (isset($lastComment) && $request->lastRecode < $lastComment->id) {
            //return $result;
            return Response::json(array(
                'success' => true,
                'lastRecode' => $lastComment->id,
                'lastComment' => $lastComment,
                'taskComment' => $taskComment,
                'msg' => $result));
        } else {
            return Response::json(array(
                'success' => false,

                'lastComment' => $lastComment,
                'taskComment' => $taskComment,
                'msg' => $result));
        }

    }

    public function addComment(Request $request)
    {
        $task_allocation = Task_Allocation::where('task_id', '=', $request->task_id)->get();
        //echo $task_allocation;
        if (Auth::User()->Role->id == 2) {
            if (Auth::User()->id != $task_allocation[0]->cm_id || Auth::User()->id != $request->comment_by) {
                return Response::json(array(
                    'success' => true,
                    'msg' => 'Can not comment on this',
                ));
            }
        } else {
            if (Auth::User()->id != $task_allocation[0]->Task->Project->client_id || Auth::User()->id != $request->comment_by) {
                return Response::json(array(
                    'success' => true,
                    'msg' => 'Can not comment on this',
                ));
            }
        }
        $comment = new Comment();
        // return $request->all();
        $comment->task_id = $request->task_id;
        $comment->description = $request->description;
        $comment->comment_by = $request->comment_by;
        $comment->is_update = 0;
        $comment->created_at = date('Y-m-d H:i:s');
        $comment->save();

        if ($request->has('file')) {
            foreach ($request->file as $file) {
                $task_media = new Task_Media();
                $uniquesavename = time() . uniqid(rand());
                $file_url = Storage::putFileAs('public/Files', $file, $uniquesavename . '-' . $file->getClientOriginalName());
                $fileName = $uniquesavename . '-' . $file->getClientOriginalName();
                $task_media->task_id = $request->task_id;
                $task_media->is_description = 1;
                $task_media->comment_id = $comment->id;
                $task_media->file = $fileName;
                $task_media->created_at = date('Y-m-d H:i:s');
                $task_media->save();
            }
        }
        $taskMediaComment = Task_Media::where([['task_id', '=', $request->task_id], ['is_description', '=', 1]])->get();
        $tasks = Task::find($request->task_id);
        $taskMedia = Task_Media::where([['task_id', '=', $request->task_id], ['is_description', '=', 0]])->get();
        //$taskComment = Comment::where([['task_id' ,'=', $request->task_id],['id' , '>' ,$comment->id ]])->get();
        $taskComment = Comment::where('id', $comment->id)->get();
        $user = Auth::user();
        //return $comment->id;
        $result = view('comment')->with('taskMediaComment', $taskMediaComment)->with('tasks', $tasks)->with('user', $user)->with('taskMedia', $taskMedia)->with('taskComment', $taskComment)->render();
        return Response::json(array(
            'success' => true,
            'msg' => $result,
            'lastRecode' => $comment->id,
        ));

    }

}
