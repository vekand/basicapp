@extends('main')

@section('title', 'All Posts')

@section('content')

<div class="row">
	<div class="col-md-9">
		<h1>{{ trans('messages.posts.posts') }}</h1>
	</div>
	<div class="col-md-3">
		<a href="{{ route('posts.create') }}" class="btn btn-lg btn-blog btn-primary btn-h1-spacing">{{ trans('messages.posts.newpost') }}</a>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12 ">
			<table class="table body-table-background">
				<thead>
					<th>#</th>
					<th>{{ trans('messages.posts.title') }}</th>
					<th>{{ trans('messages.posts.body') }}</th>
					<th title="{{ trans('messages.posts.postvisible') }}">{{ trans('messages.posts.visibility') }}</th>
					<th title="{{ trans('messages.posts.postpublic') }}">{{ trans('messages.posts.public') }}</th>
					<th>{{ trans('messages.posts.created_at') }}</th>
					<th title="{{ trans('messages.posts.idteacher') }}">{{ trans('messages.profs') }}</th>
					<th> At</th>
				</thead>
				<tbody>
					@foreach($posts as $post)
					<tr>
						<th>{{ $post->id }}</th>
						<td>{{ $post->title }}</td>
						{{-- <td>{{ substr($post->body, 0, 100) }}{{ strlen($post->body) > 100 ? "..." : "" }}</td> --}}
						<td>{{ substr(strip_tags($post->body), 0, 90) }}{{ strlen(strip_tags($post->body)) > 90 ? '...' : "" }}</td>
						<td>{{ $post->vizibil }}</td>
						<td>{{ $post->publicu }}</td>
						<td>{{ date('j M Y', strtotime($post->created_at)) }}</td>
						<td>{{ $post->prof_id }}</td>
						<td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-sm">View</a> 
						@if (Auth::check() && $post->prof_id == $user->prof_id)
						<a href="{{ route('posts.edit', $post->id) }}" class="btn btn-default btn-sm">Edit</a>
						@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
			<div class="text-center">
				{!! $posts->links() !!}
			</div>
		</div>
	</div>
</div>
@endsection