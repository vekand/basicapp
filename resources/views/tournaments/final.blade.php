@extends('main')

@section('title', 'Upload Initial')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}

@endsection

@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3 jos">
		<h2>{{ trans('messages.tournamentcreate.uploadfinallist') }}</h2>
		<hr>
		{!! Form::open(array('files' => true, 'route' => ['tournaments.postfinal', $id], 'data-parsley-validate' => '')) !!}
		<div class="col-md-6">
			{{ Form::label('prospect', trans('messages.tournamentcreate.pdf')) }}
			{{ Form::file('prospect', array('class' => 'form-control')) }}
		</div>
		
		{{ Form::submit(trans('messages.tournamentcreate.uploadfinallist'), array('class' => 'btn btn-success btn-lg btn-block distanta')) }}
		{!! Form::close() !!}
	</div>
</div>
@endsection

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}
<script type="text/javascript">
	$(".select2-multi").select2();  //plugin
</script>
@endsection