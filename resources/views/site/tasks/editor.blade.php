@extends('layouts.app')

@section('navbar')
    <h2>{{$fields->name}}</h2>
    <div class="buttons">
        <button type="submit" class="btn btn-success" form="main">SAVE</button>
        <a href="/projects/{{$project_id}}"><button class="btn btn-warning">< BACK</button></a>
    </div>
@endsection

@section('content')
    <div class="container">
        <form action="/projects/{{$project_id ?? ''}}/tasks{{$fields->id ? '/'.$fields->id : ''}}" id='main' enctype="multipart/form-data" method="post">
            @csrf
            @if($fields->id)
                @method('PATCH')
            @endif

            <input class="form-control mb-2" name="name" value="{{$fields->name}}">
            <textarea class="form-control mb-2" name="description" id="" cols="30" rows="10">{{$fields->description}}</textarea>
            <select class="form-control form-select mb-2"  aria-label=".form-select-lg example" name="status_id" id="">
                @foreach ($statuses as $status)
                    <option value="{{$status->id}}" @if ($fields->status_id === $status->id) selected  @endif >{{$status->name}}</option>
                @endforeach
            </select>
            <div class="mb-3">
                <label for="attach" class="form-label">File Upload</label>
                <input class="form-control" name="attach" type="file" id="attach">
            </div>
            
        </form>
    </div>
@endsection