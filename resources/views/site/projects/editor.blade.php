
@extends('layouts.app')

@section('navbar')
    <div></div>
    <div class="buttons">
        <a href="/projects/create"><button class="btn btn-outline-success" form="main">CREATE</button></a>
        <a href="/projects"><button type="button" class="btn btn-warning">< BACK</button></a>
    </div>
@endsection

@section('content')
    <div class="container">
        <form action="/projects" method="post" id='main'>
            @csrf
            <input class="form-control mb-2" name="name" value="{{$fields->name}}">
        </form>
    </div>
@endsection
