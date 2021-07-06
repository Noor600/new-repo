@extends('layouts.app')
@section('stylesheets')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css">
@endsection
@section('content')
    <div class="card card-default">
        <div class="card-header">
            {{ isset($post) ? 'Update Post' : 'Add new post' }}
        </div>
        <div class="card-body">
        <form class="form-group" action="{{ isset($post) ? route('posts.update', $post->id) : route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if (isset($post))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="post-title">Title :</label>
                    <input class="form-control" name="title" id="post-title"
                    type="text" placeholder="Add a new post"
                    value="{{ isset($post) ? $post->title : '' }}">
                </div>
                <div class="form-group">
                    <label for="post-desc">Description :</label>
                    <textarea class="form-control"
                    name="description" id="post-desc" 
                    type="text" placeholder="add description" 
                    rows="2">{{ isset($post) ? $post->description : '' }}</textarea>
                </div>
                <div class="form-group">
                    <label for="post content">Content :</label>
                    {{-- <textarea class="form-control" name="content" id="post content" rows="3" type="text" placeholder="add post content">{{ isset($post) ? $post->content : '' }}</textarea> --}}
                    <input id="x" type="hidden" name="content">
                    <trix-editor input="x"></trix-editor>
                </div>
                @if (isset($post))
                    <div class="form-group">
                    <img src="{{ asset('storage/' . $post->image)}}" 
                    alt="" style="width: 100%">
                    </div>
                @endif
                <div class="form-group">
                    <label for="post-image">Image :</label>
                    <input class="form-control" name="image" id="post-image" type="file">
                </div>
                <div class="form-group">
                <label for="selectCategory">Select Category</label>
                <select name="categoryID" id="selectCategory" class="form-control">
                    @foreach ($categories as $category)
                    <option value="{{$category->id}}">{{$category->name}}
                    </option>
                    @endforeach
                </select>
                </div>
                @if (!$tags->count() <= 0)
                    <div class="form-group">
                        <label for="selectTag">Select Tag</label>
                        <select name="tags[]" id="selectTag" class="form-control tags"
                        multiple>
                            @foreach ($tags as $tag)
                            <option value="{{$tag->id}}"@if (isset($post))
                                    @if ($post->hasTag($tag->id))
                                    selected
                                    @endif
                                @endif>
                                {{$tag->name}}
                            </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <div class="form-group">
                    <button class="btn btn-success mt-3" type="submit">
                        {{ isset($post) ? 'Update' : 'Add' }}
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/trix/1.2.0/trix.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.tags').select2();
        });
    </script>
@endsection