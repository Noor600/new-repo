@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="row text-center">
                <div class="col-md-4">
                    <div class="card text-white" style="background-color: #28A745">
                        <div class="card-header">Users</div>
                        <div class="card-body">{{ $users_count }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white" style="background-color: #DC3545">
                        <div class="card-header">Categories</div>
                        <div class="card-body">{{ $categories_count }}</div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card text-white" style="background-color: #FFC107">
                        <div class="card-header">Posts</div>
                        <div class="card-body">{{ $posts_count }}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection