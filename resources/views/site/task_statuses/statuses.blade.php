@extends('layouts.app')

@section('navbar')
    <h1>Statuses</h1>
    <div class="btns">

        <a href="/task-statuses/create"><button class="btn btn-outline-success" type="button">NEW</button></a>
        <a href="/projects/"><button class="btn btn-warning" type="button">< BACK</button></a>
    </div>
    
@endsection

@section('content')
    <div class="container">
        <div class="projects">
            @foreach ($statuses as $status)
                <div class="project_preview">
                    <h4><a href="/task-statuses/{{$status->id}}/edit">{{$status->name}}</a></h4>
                </div>
            @endforeach
        </div>
    </div>
@endsection
