<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\TaskStatus;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.projects.projects', [
            'projects' => Project::where('user_id', auth()->id())->paginate(18)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('site.projects.editor', [
            'fields' => new Project()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:350'
        ]);

        $project = new Project();

        $project->name = $request->name;
        $project->user_id = auth()->id();
        $project->save();

        return redirect('/projects')->with('success', 'New Project creates successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {
        return view('site.projects.project', [
            'project' => Project::with(['tasks' => function($query) use ($request){
                if($request->status){
                    $query->where([['status_id', '=', $request->status]]);
                }
            }])->where([
                ['id', '=', $id],
                ['user_id', '=', auth()->user()->id],
            ])->first(),
            'project_id' => $id,
            'statuses' => TaskStatus::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $project = Project::with('tasks')->where('id', $id)->first();

        foreach($project->tasks as $task){
            $task->delete();
        }
        $project->delete();

        return redirect('/projects')->with('warning', 'Project deleted successfully');
    }
}
