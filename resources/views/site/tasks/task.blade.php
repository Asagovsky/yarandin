@extends('layouts.app')

@section('navbar')
    <h2>{{$task->name}}</h2>
    <div class="buttons">
        <button class="btn btn-danger" form="delete">DELETE</button>
        <a href="/projects/{{$project_id}}/tasks/{{$task->id}}/edit"><button class="btn btn-warning">EDIT</button></a>
        <a href="/projects/{{$project_id}}"><button class="btn btn-warning">< BACK</button></a>
    </div>
@endsection

@section('content')
    <div class="container">
        <div class="task-description">
            <p>{{$task->description}}</p>
        </div>
        
        <div>
            @if ($task->file_path)
                <p ><a href="{{$task->file_path}}" download>Download Attach</a></p>
            @endif
        </div>
    </div>
    
@endsection

<form action="{{ route('tasks.destroy', ['project_id' => $project_id, 'task' => $task->id]) }}" id="delete" method="POST">
    @csrf
    @method('DELETE')
    
</form>