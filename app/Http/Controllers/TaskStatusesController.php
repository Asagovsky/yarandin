<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TaskStatus;

class TaskStatusesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('site.task_statuses.statuses', [
            'statuses' => TaskStatus::paginate(20)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('site.task_statuses.editor', [
            'fields' => new TaskStatus()
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

        $taskStatus = new TaskStatus();

        $taskStatus->name = $request->name;
        $taskStatus->save();

        return redirect('/task-statuses')->with('success', 'New Status created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $project = Project::with('tasks')->where('id', $id)->first();
        $task = TaskStatus::find($id);

        // $project_id = $request->project_id
        return view('site.task_statuses.editor', [
            'fields' => $task
        ]);
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
        $taskStatus = TaskStatus::find($id);

        $taskStatus->name = $request->name;

        $taskStatus->save();

        return redirect('/task-statuses/')->with('success', 'Status has been updated successfully');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $task = TaskStatus::find($id);

        // var_dump($task);
        // die();

        $task->delete();

        return redirect('/task-statuses/')->with('warning', 'Status has been deleted successfully');
    }
}
