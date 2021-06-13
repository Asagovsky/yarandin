@extends('layouts.app')

@section('navbar')
    <div><h1>{{$project->name}} Taks</h1></div>
    <div class="buttons">
        <button class="btn btn-danger" form='delete'>DELETE</button>
        <a href="/projects/{{$project_id}}/tasks/create"><button type="button" class="btn  btn-success" >NEW</button></a>
        <a href="/projects/"><button class="btn btn-warning">< BACK</button></a>
    </div>
    
@endsection





@section('content')
    <div class="container">
        <a class="pr-3" href="/projects/{{$project->id}}">All</a>
        @foreach ($statuses as $status)
            <a class="pr-3" href="/projects/{{$project->id}}?status={{$status->id}}">{{$status->name}}</a>
        @endforeach
        <hr>
        <div class="projects">
            @foreach ($project->tasks as $task)
                <div class="project_preview">
                    <h4><a href="/projects/{{$project->id}}/tasks/{{$task->id}}">{{$task->name}}</a></h4>
                </div>
            @endforeach
        </div>
    </div>
@endsection


<form action="{{ route('projects.destroy', ['project' => $project->id]) }}" id='delete' method="POST">
    @csrf
    @method('DELETE')
</form>


