<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Task;
use App\Models\TaskStatus;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.tasks.tasks', [
            'projects' => Project::with('tasks')->where('user_id', auth()->id())->paginate(20),
            'name' => 'asdasdasd'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($project_id)
    {
        return view('site.tasks.editor', [
            'fields' => new Task(),
            'project_id' => $project_id,
            'statuses' => TaskStatus::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $project_id)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:350',
            'description' => 'required|string|min:3|max:350',
            'status_id' => 'required|integer|min:1'
        ]);

        $task = new Task();

        $task->name = $request->name;
        $task->description = $request->description;
        $task->project_id = $project_id;
        $task->status_id = $request->status_id;
        if ($request->hasFile('attach')) {
            $fileFolder = 'attach/'.auth()->user()->id.'/';
            $originName = $request->file('attach')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('attach')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('attach')->move(public_path($fileFolder), $fileName);
            $url = asset($fileFolder.$fileName); 


            $task->file_path = $url;
        }
        $task->save();

        return redirect('/projects/'.$project_id)->with('success', 'New Task created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($project_id, $id)
    {
        // $project = Project::with('tasks')->where('id', $id)->first();
        $task = Task::find($id);
        // var_dump($id);
        // die();
        // $project_id = $request->project_id
        return view('site.tasks.task', [
            'task' => $task,
            'project_id' => $project_id
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($project_id, $id)
    {
        // $project = Project::with('tasks')->where('id', $id)->first();
        $task = Task::find($id);


        // $project_id = $request->project_id
        return view('site.tasks.editor', [
            'fields' => $task,
            'project_id' => $project_id,
            'statuses' => TaskStatus::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $project_id, $id)
    {
        $task = Task::find($id);

        $task->name = $request->name;
        $task->description = $request->description;
        $task->status_id = $request->status_id;
        if ($request->hasFile('attach')) {
            $fileFolder = 'attach/'.auth()->user()->id.'/';
            $originName = $request->file('attach')->getClientOriginalName();
            $fileName = pathinfo($originName, PATHINFO_FILENAME);
            $extension = $request->file('attach')->getClientOriginalExtension();
            $fileName = $fileName.'_'.time().'.'.$extension;
            $request->file('attach')->move(public_path($fileFolder), $fileName);
            $url = asset($fileFolder.$fileName); 

            $task->file_path = $url;
        }

        $task->save();

        return redirect('/projects/'.$project_id.'/tasks/'.$id)->with('success', 'Task has been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($project_id, $id)
    {
        $task = Task::find($id);

        // var_dump($task);
        // die();

        $task->delete();

        return redirect('/projects/'.$project_id)->with('warning', 'Task has been deleted successfully');
    }

}
