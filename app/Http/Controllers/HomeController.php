<?php
namespace App\Http\Controllers;
use App\Allocation;
use App\Task;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function errorPage()
    {
        if (auth()->user()->hasRole('client')) {
            return redirect('/client/home');
        }
        if (auth()->user()->hasRole('CM')) {
            return redirect('/cm/home');
        }
        if (auth()->user()->hasRole('HR')) {
            return redirect('/hr/home');
        }
        if (auth()->user()->hasRole('director')) {
            return redirect('/admin/home');
        }
        return view('error.404');
    }

    // This function is used to change status of user
    public function changeStatus($id, $pageID)
    {

        $user = User::find($id);
        $user->is_approved = !($user->is_approved);
        $user->save();
        return redirect('registerRequests/' . $pageID);
    }

    public function showAllocatedManagers()
    {
        $user_id = Auth::user()->id;
        $allocated_managers = Allocation::where([['client_id', '=', $user_id], ['is_activated', '=', 1]])->get();
        return view('showAllocatedManagers')

            ->with('user', Auth::user())
            ->with('allocated_managers', $allocated_managers);

    }
    //getFile form storage
    public function getFile($filename, $taskId)
    {
        // return $task_id;
        $userName = explode("-", $filename);
        $filename = "public/Files/" . $filename;
        //return $filename;

        $name='';
        
        for($i=1;$i<count($userName);$i++)
        {
            $name.= $userName[$i];
            if($i<count($userName)-1)
            {
                $name.= "-";
            }
        }
        $task = Task::find($taskId);
        if (!Auth::check()) {
            return view('error.404');
        }
        if (!isset($task)) {
            return view('error.404');
        }
        $id = Auth::User()->id;
        $isClient = $task->project->client_id;
        $isCm = $task->allocateTo->cm_id;

        if ($id == $isClient || $id == $isCm) {
            // return "true";
            if (!Storage::disk('local')->has($filename)) {
                return view('error.404');
            } else {
                return $file = Storage::download($filename, $name);
            }
        } else {
            //return "123";
            return view('error.404');
        }

    }
}
