@extends('main')

@section('title', 'Photos')

@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3 jos">
		<h1>{{ trans('messages.tournamentcreate.addimage')}}<small>  {{ trans('messages.tournamentcreate.multi')}}</small></h1>
		<hr>
		{!! Form::open(array('files' => true, 'route' => ['tournaments.postimages', $id], 'data-parsley-validate' => '')) !!}
		<div class="col-md-6">
			{{ Form::label('foto', trans('messages.tournamentcreate.typeimage')) }}
			{{ Form::file('foto[]', array('multiple' =>true, 'class' => 'form-control')) }}
		</div>
		
		{{ Form::submit(trans('messages.tournamentcreate.addimage'), array('class' => 'btn btn-success btn-lg btn-block distanta')) }}
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