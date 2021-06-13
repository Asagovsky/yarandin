@extends('layouts.app')

@section('content')
    <div class="container">
            <h1>PROJECTS</h1>
            <div class="projects">
                {{-- {{var_dump($name)}} --}}
                @foreach ($projects as $project)
                    <div class="project_preview">
                        <h4><a href="/projects/{{$project->id}}">{{$project->name}}</a></h4>
                    </div>
                @endforeach
            </div>
    </div>
@endsection
