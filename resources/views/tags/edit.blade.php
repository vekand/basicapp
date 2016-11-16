@extends('main')

@section('title', "| Edit Tag")

@section('content')
<div class="row">
	{!! Form::model($tag, ['route' => ['tags.update', $tag->id], 'method' => 'PUT']) !!}
	<div class="col-md-8">
		{{ Form::label('name', 'Name:') }}
		{{ Form::text('name', null, ['class' => 'form-control input-lg']) }}
		
		{!! Form::submit('Save Changes',['class'=>'btn btn-success btn-h1-spacing'] ) !!}                  
		{!! Form::close() !!}
	</div>
</div>

@endsection