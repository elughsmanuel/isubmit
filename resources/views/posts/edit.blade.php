@extends('layouts.app')

@section('content')
    <h1>Edit Assignment</h1>
    {!! Form::open(['action' => ['App\Http\Controllers\PostsController@update', $post->id], 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
        <div class="form-group mb-3">
            {{Form::label('fullname', 'Full Name', ['class' => 'form-label'])}}
            {{Form::text('fullname', $post->fullname, ['class' => 'form-control bg-white', 'placeholder' => 'Full Name'])}}
        </div>
        <div class="form-group mb-3">
            {{Form::label('matricnumber', 'Matric Number', ['class' => 'form-label'])}}
            {{Form::text('matricnumber', $post->matricnumber, ['class' => 'form-control bg-white', 'placeholder' => 'Matric Number'])}}
        </div>
        <div class="form-group mb-3">
            {{Form::label('coursecode', 'Course Code', ['class' => 'form-label'])}}
            {{Form::select('coursecode', ['CSC 111'=>'CSC 111', 'CSC 205'=>'CSC 205'], $post->coursecode, ['class' => 'form-control bg-white', 'placeholder' => 'Course Code'])}}
        </div>
        <div class="form-group mb-3">
            {{Form::label('department', 'Department', ['class' => 'form-label'])}}
            {{Form::text('department', $post->department, ['class' => 'form-control bg-white', 'placeholder' => 'Department'])}}
        </div>
        <div class="form-group mb-3">
            {{Form::label('faculty', 'Faculty', ['class' => 'form-label'])}}
            {{Form::text('faculty', $post->faculty, ['class' => 'form-control bg-white', 'placeholder' => 'Faculty'])}}
        </div>
        <div class="form-group mb-3">
            {{Form::label('email', 'Email Address', ['class' => 'form-label'])}}
            {{Form::text('email', $post->email, ['class' => 'form-control bg-white', 'placeholder' => 'Email Address'])}}
        </div>
        <div class="form-group mb-3">
            {{Form::label('file', 'File', ['class' => 'form-label'])}}
            {{Form::text('file', $post->file, ['class' => 'form-control bg-white', 'placeholder' => 'File', 'readonly'])}}
        </div>
        <div class="form-group mb-5">
            {{Form::file('file')}}
        </div>
        <hr>
        {{Form::hidden('_method', 'PUT')}}
        <a href="/posts/{{$post->id}}" class="btn btn-outline-secondary" role="button">Go Back</a>
        {{Form::submit('Admin Submit', ['class' => 'btn btn-primary float-end', 'name' => 'submitbutton'])}}
    {!! Form::close() !!}
@endsection

