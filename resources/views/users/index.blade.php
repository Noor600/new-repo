@extends('layouts.app')

@section('content')

    <div class="card card-default mt-3">
            <div class="card-header">All User</div>
            @if ($users->count(0) > 0)
			<div class="card-body">
				<table class="table">
					<thead>
						<tr>
							<th>Image</th>
							<th>Name</th>
							<th>Status</th>
							
						</tr>
					</thead>
					<tbody>
							@foreach ($users as $user)
							<tr>
								{{-- <td>
									<img src="{{ asset('storage/'.$user->image) }}" width="100px" height="50px" alt="">
                                </td> --}}
                                <td>
									<img src="{{ $user->hasPicture() ? asset('storage/'.$user->getPicture()) : $user->getGravatar()}}" style="border-radius: 50%;" height="60px" width="60px">
                                </td>
								<td>
									{{ $user->name }}
                                </td>
                                <td>
									@if (!$user->isAdmin())
										<form action="{{route('users.make-admin', $user->id)}}" method="POST">
											@csrf
												<button class="btn btn-success btn-sm" type="submit">Make Admin</button>
												
										</form>
									@else
									<form action="{{route('users.make-writer', $user->id)}}" method="POST">
										@csrf
										<button class="btn btn-primary btn-sm" type="submit">Make Writer</button>
										{{-- {{ $user->role }} --}}
									</form>
									@endif
                                    
                                </td>
								{{-- <td>
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
								</td> --}}
							</tr>
					</tbody>
					@endforeach
				</table>
				@else
				<div class="card-body">
					<h3 class="text-center">
						No Users Yet
					</h3>
				</div>
				@endif
        </div>
    </div>
@endsection