<?php

namespace App\Http\Controllers;

use App\Allocation;
use App\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function index()
    {
        $projects = Project::where('client_id', '=', Auth::user()->id)->orderBy('is_completed', 'asc')->get();
        $isAllocated = Allocation::where([['client_id', '=', Auth::user()->id], ['is_activated', '=', '1']])->get()->isEmpty();
        $currentDate = date('Y-m-d');
        return view('projects')
            ->with('projects', $projects)
            ->with('currentDate', $currentDate)
            ->with('isAllocated', $isAllocated);
    }

    public function addNewProject(Request $request)
    {
        $project = new Project();
        $project->title = $request->title;
        $project->description = $request->description;
        $project->client_id = Auth::user()->id;
        $project->is_completed = 0;
        $project->start = date('Y-m-d H:i:s');
        $project->end = date('Y-m-d H:i:s');
        $project->save();
        session()->flash('message', "Project Created Successfully");
        return redirect("/client/projects");
    }
    public function viewAllProjects()
    {
        $projects = Project::all();
        return view('allProjects')->with('projects', $projects);
    }
   
}
