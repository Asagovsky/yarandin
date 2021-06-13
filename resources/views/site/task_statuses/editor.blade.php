@extends('layouts.app')

@section('navbar')
    <h2>{{$fields->name}}</h2>
    <div class="buttons">

        @if($fields->id)
            <button class="btn btn-danger" form="delete">DELETE</button>
        @endif
        <button type="submit" class="btn btn-success" form="main">SAVE</button>
        <a href="/task-statuses"><button class="btn btn-warning">< BACK</button></a>
    </div>
@endsection

@section('content')
    <div class="container">
        <form action="/task-statuses{{$fields->id ? '/'.$fields->id : ''}}" method="post" id='main'>
            @csrf
            @if($fields->id)
                @method('PATCH')
            @endif

            <input class="form-control mb-2" name="name" value="{{$fields->name}}">
        </form>
    </div>
@endsection

@if($fields->id)
    <form action="{{ route('task-statuses.destroy', ['task_status' => $fields->id]) }}" id="delete" method="POST">
        @csrf
        @method('DELETE')
        
    </form>
@endif
