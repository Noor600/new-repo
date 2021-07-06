@extends('layouts.app')

@section('content')
    @if (session()->has('error'))
        <div style="border: none; border-left: 5px solid #FF0033; background-color: #E8E8E8;" class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    <div class="clearfix">
        <a class="btn btn-primary float-right"
        href="{{ route('tags.create') }}">
        Add Tag <i class="fa fa-plus"></i>
        </a>
    </div>
    <div class="card card-default mt-3">
        <div class="card-header">All Tags</div>
        <div class="card-body">
        <table class="table">
            <tbody>
                    @foreach ($tags as $tag)
                    <tr>
                        <td>
                            {{ $tag->name }} <span class="badge
                            badge-primary ml-2">{{$tag->posts->count()}}</span>
                        </td>
                        <td>
                        <form class="float-right" action="{{ route('tags.destroy', $tag->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Delete
                            </button>
                        </form>
                            <a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-success btn-sm float-right mr-2">Edit</a>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
        </div>
    </div>
@endsection