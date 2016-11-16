@extends('main')

@section('title', "| Edit Tag")
@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}

@endsection
@section('content')

<div class="row">
	{!! Form::model($carousel, ['files' => true, 'route' => ['carousel.update', $carousel->id], 'method' => 'PUT']) !!}
	<div class="col-md-6">
		{{ Form::label('title', trans('messages.carousel.title')) }}
		{{ Form::text('title', $carousel->title, ['class' => 'form-control input-lg']) }}

		{{ Form::label('img', trans('messages.carousel.file')) }}
		{{ Form::file('img', array('class' => 'form-control')) }}
		
		{{ Form::label('body', trans('messages.carousel.body')) }}
		{{ Form::text('body', $carousel->body, ['class' => 'form-control input-lg']) }}

		{{ Form::label('readmore', trans('messages.carousel.mesaj')) }}
		{{ Form::text('readmore', $carousel->readmore, ['class' => 'form-control input-lg']) }}

		{!! Form::submit('Save Changes',['class'=>'btn btn-success btn-h1-spacing'] ) !!}                  
		{!! Form::close() !!}
	</div>
</div>

@endsection
@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}
@endsection