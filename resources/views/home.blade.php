@extends('layouts.app')

@section('content')
    <div class="card">
        <div class="card-header">{{ __('Dashboard') }}</div>
        <div class="card-body">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{ session('status') }}
                </div>
            @endif
            {{ __('You are logged in!') }}
            <br> <br>
            <a href="/posts/create" class="btn btn-primary mb-3" role="button">Submit Assignment</a>
            <hr>
            <div class="row">
                <div class="col-md-4">
                    <div class="box bg-success text-white text-center text-uppercase p-4 rounded mb-4">
                        <h2>{{$posts->count()}}</h2>
                        <h5>Total assignments</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box bg-danger text-white text-center text-uppercase p-4 rounded mb-4">
                        <h2>0</h2>
                        <h5>Total courses</h5>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="box bg-secondary text-white text-center text-uppercase p-4 rounded mb-4">
                        <h2>0</h2>
                        <h5>Total users</h5>
                    </div>     
                </div>
            </div>
            </div>
        </div>
    </div>
@endsection
