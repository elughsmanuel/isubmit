@extends('layouts.app')

@section('content')
    <h1>Assignments</h1>
    @if(count($posts) > 0)
        @foreach($posts as $post)
            <div class="well card card-body bg-light mb-4">
                <h3><a href="/posts/{{$post->id}}" class="text-decoration-none">{{$post->fullname}}</a></h3>
                <p>{{$post->coursecode}}  &#8226;  {{$post->matricnumber}}</p>
                <small>Submitted on {{$post->created_at}}</small>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No assignments found</p>
    @endif
@endsection