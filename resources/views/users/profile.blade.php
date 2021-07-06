@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            <h3>Profile</h2>
        </div>
        <div class="card-body">
        <form class="form-group" action="{{ route('users.update', $user->id)}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Name :</label>
                    <input autofocus class="form-control"
                    name="name"
                    id="name" 
                    type="text" 
                    value="{{ $user->name}}">
                    {{--  @error('name')
                        <div style="border: none; border-left: 5px solid #FF5297; background-color: #E8E8E8; " class="alert alert-danger mt-2">
                            <span style="color: #8F8F8F">{{ $message }}</span>
                        </div>
                    @enderror --}}
                </div> 
                <div class="form-group">
                    <label for="email">Email :</label>
                        <input type="text" id="email" name="email" value="{{$user->email}}"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="about">About :</label>
                    <textarea class="form-control"
                    name="about" id="about" 
                    type="text" placeholder="Tell us about you" 
                    rows="2">{{$profile->about}}</textarea>
                </div>
                <div class="form-group">
                    <label for="facebook">Facebook :</label>
                        <input type="text" name="facebook" id="facebook" value="{{$profile->facebook}}"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="twitter">Twitter :</label>
                        <input type="text" id="twitter" name="twitter" value="{{$profile->twitter}}"
                        class="form-control">
                </div>
                <div class="form-group">
                    <label for="pic">Picture :</label><br>
                    <img src="{{$user->hasPicture() ? asset('storage/'.$user->getPicture()) : $user->getGravatar() }}" style="border-radius: 1%" width="80px" height="80px">
                    <input type="file" id="pic" name="picture" value="{{$profile->picture}}"
                        class="form-control mt-2">
                </div>
                <div class="form-group">
                    <button class="btn btn-success">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection