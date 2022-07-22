@extends('layouts.app')

@section('content')
    <a href="/posts" class="btn btn-outline-secondary mb-4" role="button">Go Back</a>
    <h1>{{$post->fullname}}</h1>
    <br>
    <div>
        <p><span class="fw-bold">Matric Number:</span> {!!$post->matricnumber!!}</p>
        <p><span class="fw-bold">Course Code:</span> {!!$post->coursecode!!}</p>
        <p><span class="fw-bold">Department:</span> {!!$post->department!!}</p>
        <p><span class="fw-bold">Faculty:</span> {!!$post->faculty!!}</p>
        <p><span class="fw-bold">Email Address:</span> {!!$post->email!!}</p>
        <p><span class="fw-bold">File:</span> {!!$post->file!!}</p>
        <a href="/storage/files/{{$post->file}}" target="_blank" class="btn btn-primary" role="button">View</a>
    </div>
    <hr>
    <small class="fw-bold">Submitted on {{$post->created_at}}</small>
    <hr>
        <a href="{{$post->id}}/edit" class="btn btn-outline-secondary" role="button">Edit</a>
        {!!Form::open(['action' => ['App\Http\Controllers\PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-end'])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
        {!!Form::close()!!}

@endsection