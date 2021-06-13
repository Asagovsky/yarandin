@extends('layouts.app')
@section('navbar')

    <h1>PROJECTS</h1>
    <div class="btns">
        <a href="/task-statuses"><button class="btn btn-warning" type="button">Task Statuses</button></a>
        <a href="/projects/create"><button class="btn btn-outline-success" type="button">NEW</button></a>
    </div>
    
@endsection

@section('content')
    
    <div class="container">
        <div class="projects">
            @foreach ($projects as $project)
                <div class="project_preview">
                    <h4><a href="/projects/{{$project->id}}">{{$project->name}}</a></h4>
                </div>
            @endforeach
        </div>
        {{ $projects->links() }}
    </div>
    
@endsection


