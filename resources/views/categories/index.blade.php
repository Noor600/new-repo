@extends('layouts.app')

@section('content')
    @if (session()->has('error'))
        <div style="border: none; border-left: 5px solid #FF0033; background-color: #E8E8E8;" class="alert alert-danger">
            {{ session()->get('error') }}
        </div>
    @endif
    <div class="clearfix">
        <a class="btn btn-primary float-right"
        href="{{ route('categories.create') }}">
        Add category <i class="fa fa-plus"></i>
        </a>
    </div>
    <div class="card card-default mt-3">
        <div class="card-header">All Categories</div>
        <div class="card-body">
        <table class="table">
            <thead>
                <tr>
                    <td><b>ID</b></td>
                    <td><b>Category name</b></td>
                </tr>
            </thead>
            <tbody>
                    @foreach ($categories as $category)
                    <tr>
                        <td>
                            {{ $category->id }}
                        </td>
                        <td>
                            {{ $category->name }}
                        </td>
                        <td>
                        <form class="float-right" action="{{ route('categories.destroy', $category->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">
                                Delete
                            </button>
                        </form>
                            <a href="{{ route('categories.edit', $category->id) }}" class="btn btn-success btn-sm float-right mr-2">Edit</a>
                        </td>
                    </tr>
                </tbody>
            @endforeach
        </table>
        </div>
    </div>
@endsection