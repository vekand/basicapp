@extends('main')

@section('title', 'New Tournament')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}
{!! Html::style('css/datepicker.css') !!}

@endsection

@section('content')
<div class="row">
	<div class="col-md-8 col-md-offset-2 jos">
		<h1>{{ trans('messages.tournamentcreate.title') }}</h1>
		<hr>
		{!! Form::open(array('files' => true, 'route' => 'tournaments.store', 'data-parsley-validate' => '')) !!}
		{{ Form::label('descriere', trans('messages.tournamentcreate.description')) }}
		{{ Form::text('descriere', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
		<div class="row">
			<div class="col-md-6">
				{{ Form::label('prospect', trans('messages.tournamentcreate.file')) }}
				{{ Form::file('prospect', array('class' => 'form-control')) }}
			</div>
			<div class="col-md-6">
				{{ Form::label('posted_at', trans('messages.tournamentcreate.posted_at')) }}
				{{ Form::text('posted_at', \Carbon\Carbon::now()->format('Y-m-d') , array('id' => 'datepicker', 'class' => 'form-control datepicker', 'required' => '')) }}
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				{{ Form::label('slug', 'Slug:') }}
				{{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '3', 'maxlength' =>'20')) }}
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				{{ Form::label('nrrunde', trans('messages.tournamentcreate.rounds')) }}
				{{ Form::input('number','nrrunde', null, array('class' => 'form-control', 'required' => '')) }}
			</div>
		</div>	
		{{ Form::label('perioada', trans('messages.tournamentcreate.period')) }}
		{{ Form::text('perioada', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
		<div class="row">
			<div class="col-md-6">
				{{ Form::label('localit', trans('messages.tournamentcreate.city')) }}
				{{ Form::text('localit', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
			</div>
			<div class="col-md-6">
				{{ Form::label('tara', trans('messages.tournamentcreate.country')) }}
				{{ Form::text('tara', null, array('class' => 'form-control', 'maxlength' => '255')) }}
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				{{ Form::label('stare', trans('messages.tournamentcreate.status')) }}
				{{ Form::text('stare', null, array('class' => 'form-control', 'maxlength' => '255')) }}
			</div>
			<div class="col-md-6">
				{{ Form::label('obs', trans('messages.tournamentcreate.remarqs')) }}
				{{ Form::text('obs', null, array('class' => 'form-control', 'maxlength' => '255')) }}
			</div>
		</div>

		{{ Form::label('chesssite', trans('messages.tournamentcreate.chessresult')) }}
		{{ Form::text('chesssite', null, array('class' => 'form-control', 'maxlength' => '255')) }}

		{{ Form::submit(trans('messages.tournamentcreate.create'), array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
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
<script type="text/javascript">
	$( function() {
		$( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
	} );
</script>
@endsection