@extends('main')

@section('title', 'Upload PGN')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}

@endsection

@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3 jos">
		<h2>{{ trans('messages.courses.addpgn') }}</h2>
		<hr>
		{!! Form::open(array('files' => true, 'route' => ['pgnpost', $course->id], 'data-parsley-validate' => '')) !!}
		<div class="col-md-6">
			{{ Form::label('pgnfile', trans('messages.courses.pgn')) }}
			{{ Form::file('pgnfile', array('class' => 'form-control')) }}
		</div>
		
		{{ Form::submit(trans('messages.courses.addpgn'), array('class' => 'btn btn-success btn-lg btn-block distanta')) }}
		{!! Form::close() !!}

	</div>
</div>
@endsection

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}
<script type="text/javascript">

</script>
@endsection