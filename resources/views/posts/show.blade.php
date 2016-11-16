@extends('main')

@section('title', 'View Post')

@section('content')

<div class="row">
	<div class="col-md-8 sus">
	@if ($post->fisier)	
	@if (substr($post->fisier, -4) == '.pdf')
	<iframe src="{{ asset('/posts/'. $post->fisier) }}" title="pdf" align="top" height="620" width="100%" frameborder="0" scrolling="auto" target="Pdf">
	</iframe>
	@endif
	@if (substr($post->fisier, -4) == '.jpg' || substr($post->fisier, -4) == '.jpeg' || substr($post->fisier, -4) == '.png' || substr($post->fisier, -4) == '.gif')
	<img src="{{ asset('/posts/'. $post->fisier) }}" style="max-width:600px; max-height:400px;" >
	@endif
	@if (substr($post->fisier, -4) == '.avi' || substr($post->fisier, -4) == '.mp4')
	<video width="320" height="300" controls="controls">
				<source src="{{ asset('/posts/'. $post->fisier) }}" type="video/mp4">
					<source src="{{  asset('/posts/'. $post->fisier) }}" type="video/ogg">
						<source src="{{ asset('/posts/'. $post->fisier) }}" type="video/webm">
						</video>
	@endif
	@endif
		<h1>{{ $post->title }}</h1>
		{{-- <p class="lead">{{ $post->body }}</p> --}}
		{{-- <p>{{ strip_tags($post->body) }}</p> --}}
		<p>{!! $post->body !!}</p>
		<hr>
		<div class="tag">Tags:
			@foreach($post->tags as $tag)
			<span class="label label-default">{{ $tag->name }}</span>
			@endforeach
		</div>
		<div class="backend-comments" style="margin-top: 50px;">
			<h3>{{ trans('messages.posts.comments') }} <small>{{ $post->comments()->count() }}</small></h3>
			<table class="table body-table-background">
				<thead>
					<th>#</th>
					<th>{{ trans('messages.comments.name') }}</th>
					<th>{{ trans('messages.comments.email') }}</th>
					<th>{{ trans('messages.comments.comment') }}</th>
					<th style="width:70px;"> At</th>
				</thead>
				<tbody>
					@foreach($post->comments()->paginate(5) as $comment)
					<tr>
						<th>{{ $comment->id }}</th>
						<td>{{ $comment->name }}</td>
						<td>{{ $comment->email }}</td>
						<td>{{ substr(strip_tags($post->comment), 0, 250) }}{{ strlen(strip_tags($post->comment)) > 250 ? '...' : "" }}</td>
						@if (Auth::check())
						<td><a href="{{ route('comments.edit', $comment->id) }}" class="btn btn-primary btn-xs"><span class="glyphicon glyphicon-pencil"></span></a>

							<a href="{{ route('comments.delete', $comment->id) }}" class="btn btn-danger btn-xs"><span class="glyphicon glyphicon-trash"></span></a> </td> 
							@endif
						</tr>
						@endforeach
					</tbody>
				</table>
				<div class="text-center">
					{{ $post->comments()->paginate(5) }}
				</div>
			</div>
		</div>
		

		<div class="col-md-4">
			<div class="well form-spacing-top">
				<dl class="dl-horizontal">
					<label>Url: </label>
					<p><a href="{{ route('blog.single', $post->slug)  }}">{{ url('blog/'.$post->slug)  }}</a></p>
				</dl>
				<dl class="dl-horizontal">
					<label>Category: </label>
					<p>{{ $post->category->name }}</p>
				</dl>
				<dl class="dl-horizontal">
					<label>Created at:</label>
					<p>{{ date('M j, Y G:i', strtotime($post->created_at)) }}</p>
				</dl>
				<dl class="dl-horizontal">
					<label>Last updated:</label>
					<p>{{ date('M j, Y G:i', strtotime($post->updated_at)) }}</p>
				</dl>
				<hr>
				<div class="row">
					<div class="col-sm-6">
					@if (Auth::check() &&  $post->prof_id == $user->prof_id)
						{!! Html::linkRoute('posts.edit', 'Edit', array($post->id), array('class' =>'btn btn-primary btn-block')) !!}
					@endif	
					</div>
					<div class="col-sm-6">
						{!! Form::open(['route' => ['posts.destroy', $post->id], 'method' => 'DELETE', 'onsubmit' => 'return confirm("Delete ?")']) !!}
						{!! Form::submit('Delete', ['class' => 'btn btn-danger btn-block']) !!}
						{!! Form::close() !!}
					</div>
				</div>
				<br>
				<div class="row">
					<div class="col-sm-12">
						{!! Html::linkRoute('posts.index', '<<< See All Post', [], array('class' =>'btn btn-blog btn-default btn-block')) !!}
					</div>
				</div>
			</div>
		</div>
	</div>
	@endsection