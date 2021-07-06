@extends('layouts.app')

@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($category) ? "Update Category" : "Add new Category" }}
        </div>
        <div class="card-body">
        <form class="form-group" action="{{ isset($category) ? route('categories.update', 
        $category->id) : route('categories.store') }}" method="POST">
                @csrf
                @if (isset($category))
                    @method('PUT')
                @endif
            
                <div class="form-group">
                    <label for="category">Category Name :</label>
                    <input class="@error("name") is-invalid @enderror form-control"
                    name="name"
                    id="category" 
                    type="text" 
                    placeholder="{{isset($category) ? "Update" : "Add new category"}}"
                    value="{{ isset($category) ? $category->name : "" }}">
                    @error('name')
                        <div style="border: none; border-left: 5px solid #FF5297; background-color: #E8E8E8; " class="alert alert-danger mt-2">
                            <span style="color: #8F8F8F">{{ $message }}</span>
                        </div>
                    @enderror
                </div>
                <div class="form-group">
                    <button class="btn btn-success">
                        {{ isset($category) ? "Update" : "Add" }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection