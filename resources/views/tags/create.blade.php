@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($tag) ? "Update Tag" : "Add new Tag" }}
        </div>
        <div class="card-body">
        <form class="form-group" action="{{ isset($tag) ? route('tags.update', 
        $tag->id) : route('tags.store') }}" method="POST">
                @csrf
                @if (isset($tag))
                    @method('PUT')
                @endif
            
                <div class="form-group">
                    <label for="tag">Tag Name :</label>
                    <input class="@error("name") is-invalid @enderror form-control"
                    name="name"
                    id="tag" 
                    type="text" 
                    placeholder="{{isset($tag) ? "Update" : "Add new tag"}}"
                    value="{{ isset($tag) ? $tag->name : "" }}">
                    @error('name')
                        <div style="border: none; border-left: 5px solid #FF5297; background-color: #E8E8E8; " class="alert alert-danger mt-2">
                            <span style="color: #8F8F8F">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-success">
                        {{ isset($tag) ? "Update" : "Add" }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection