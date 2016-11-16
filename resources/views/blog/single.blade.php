@extends('main')
<?php $titleTag = htmlspecialchars($post->title); ?>
@section('title', $titleTag)

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}

@endsection

@section('content')

<div class="row singleblog">
	<div class="col-md-8 col-md-offset-2 sus">
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
		<p>{!! $post->body !!}</p>
		<hr>
		<p>Posted In Category: <span style="font-size:18px; font-weight:bold; color:blue;">{{ $post->category->name }}</span> </p>
	</div>
</div>
<div class="row">
	<div class="col-md-8 col-md-offset-2 ">
	<h3 class="comments-title"><span class="glyphicon glyphicon-comment"></span>  {{ $post->comments->count() }}  Comments:</h3>
		@foreach ($post->comments as $comment)
		<div class="comment">
			<div class="author-info">
				<img src="{{ "https://www.gravatar.com/avatar/" . md5(strtolower(trim($comment->email))) ."?s=50&d=wavatar" }}" class="author-image">
				<div class="author-name">
					<h4>{{ $comment->name }}</h4>
					<p class="author-time">{{ date('F nS, Y - G:i', strtotime($comment->created_at)) }}</p>
				</div>

			</div>
	
			<div class="comment-content">{{ $comment->comment }}</div>
		</div>
		@endforeach
	</div>
</div>
<div class="row">
	<div id="comment-form">
		{!! Form::open(array('route' => ['comments.store', $post->id], 'data-parsley-validate' => '', 'method' => 'POST', 'id' => 'formcomment')) !!}
		<div class="col-md-8 col-md-offset-2 form-spacing-top jos">
			<div class="row">
				<div class="col-md-6">
					{{ Form::label('name', trans('messages.singleblog.name')) }}
					{{ Form::text('name', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
				</div>
				<div class="col-md-6">
					{{ Form::label('email', trans('messages.singleblog.email')) }}
					{{ Form::text('email', null, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					{{ Form::label('comment', trans('messages.singleblog.comment')) }}
					{{ Form::textarea('comment', null, ['class' => 'form-control', 'required' => '','maxlength' => '1000', 'rows' => '5']) }}
				</div>
			</div>
			@if (App::environment('production')) 
   				<div class="g-recaptcha form-spacing-top" data-sitekey="6Le2kAkUAAAAANHnOicTSKCpX_7uJecvrNdf_jd5"></div>
			@endif
			<div class="row">
				<div class="col-md-12">
					{{ Form::submit(trans('messages.singleblog.sendmess'), ['class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;']) }}
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
 
@endsection

@section('scripts')
<!-- {!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!} -->
<script type="text/javascript">
    $(function() { 
      $('#formcomment').submit(function(event){
       var verified = grecaptcha.getResponse();
       if (verified.length === 0){
            event.preventDefault();
       }      
     });
    });
  </script>
@endsection