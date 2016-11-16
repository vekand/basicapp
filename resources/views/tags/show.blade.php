@extends('main')

@section('title', "| $tag->name Tag")

@section('content')
<div class="row">
	<div class="col-md-8">
		<h1>Tag {{ $tag->name }}<small>   {{ $tag->posts()->count() }} Posts</small></h1>
		<!-- <p class="lead">{{ $tag->body }}</p> -->
		<hr>

	</div>
	<div class="col-md-2">
		<a href="{{ route('tags.edit', $tag->id) }}" class="btn btn-lg btn-primary pull-right btn-h1-spacing btn-block">Edit</a>
	</div>
	<div class="col-md-2">
		{!! Form::open(['route' => ['tags.destroy', $tag->id], 'method' => 'DELETE', 
		'onsubmit' => 'return confirm("Delete ?")']) !!}
		{{ Form::submit("Delete", ['class' => 'btn btn-lg btn-danger btn-block btn-h1-spacing']) }}
		{!! Form::close() !!}
	</div>
</div>
<div class="row">
	<div class="col-md-12">
		<table class="table">
			<thead>
				<tr>
					<th>#</th>
					<th>Title</th>
					<th>Tags</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($tag->posts as $post)
				<tr>
					<td>{{ $post->id }}</td>
					<td>{{ $post->title }}</td>
					<td>
						@foreach ($post->tags as $tag)
						-<span class="label label-default"> {{ $tag->name }} </span>-
						@endforeach
					</td>
					<td><a href="{{ route('posts.show', $post->id) }}" class="btn btn-default btn-xs">View</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
	@endsection