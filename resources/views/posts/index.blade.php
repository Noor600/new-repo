@extends('layouts.app')

@section('content')
    <div class="clearfix">
        <a class="btn btn-primary float-right"
        href="{{ route('posts.create') }}">
        Add Post <i class="fa fa-plus"></i>
        </a>
    </div>
    <div class="card card-default mt-3">
            <div class="card-header">All Posts</div>
            @if ($posts->count(0) > 0)
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Image</th>
							<th>Tite</th>
							<th><b>Actions</b></th>
							
						</tr>
					</thead>
					<tbody>
							@foreach ($posts as $post)
							<tr>
								<td>
									<img src="{{ asset('storage/'.$post->image) }}" width="100px" height="50px" alt="">
								</td>
								<td>
									{{ $post->title }}
								</td>
								<td>
								<form class="float-right" action="{{ route('posts.destroy', $post->id) }}" method="POST">
									@csrf
									@method('DELETE')
									<button class="btn btn-danger btn-sm ml-2">
										{{ $post->trashed() ? 'Delete' : 'Trash' }}
									</button>
								</form>
								@if (!$post->trashed())
									<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-success btn-sm float-right mr-2">Edit</a>
								@else
								<a href="{{route('trashed.restore', $post->id)}}"
								class="btn btn-primary float-right btn-sm">Restore</a>
								@endif
								</td>
							</tr>
					</tbody>
					@endforeach
				</table>
				@else
				<div class="card-body">
					<h3 class="text-center">
						No posts yet
					</h3>
				</div>
				@endif
        </div>
    </div>
@endsection