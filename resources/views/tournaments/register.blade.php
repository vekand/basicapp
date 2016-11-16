@extends('main')

@section('title', 'Register')
@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}
{!! Html::style('css/datepicker.css') !!}

@endsection
@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3 jos">
		<h2>{{ trans('messages.tournamentcreate.register') }}</h2>
		<h4>{{ $tournament->descriere  }}</h4>
		<hr class="colorgraph"><br>
		{!! Form::open(array('route' => ['tournamentpostregister', 'id' => $tournament->id], 'data-parsley-validate' => '', 'id' => 'formreg', 'class' => 'form-horizontal', 'method' => "POST"))  !!}
		<div class="row">
			<div class="col-md-6">
				{{ Form::label('last_name', trans('messages.tournamentcreate.lastname')) }}
				{{ Form::text('last_name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

			</div>
			<div class="col-md-6">
				{{ Form::label('first_name', trans('messages.tournamentcreate.firstname')) }}
				{{ Form::text('first_name', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
			</div>
		</div>
		<div class="row">
			<div class="col-md-3">
				{{ Form::label('category', trans('messages.tournamentcreate.category')) }}
				{{ Form::text('category', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('elo', trans('messages.tournamentcreate.elo')) }}
				{{ Form::text('elo', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
				
			</div>
			<div class="col-md-3">
				{{ Form::label('group', trans('messages.tournamentcreate.group')) }}
				<select class="form-control" name="group">
					@foreach($ages as $age)
					<option value="{{ $age->id }}">{{ $age->category }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-3">
				{{ Form::label('gender', trans('messages.tournamentcreate.gender')) }}
				<select class="form-control" name="gender">
					<option value="M" selected="selected">M</option>
					<option value="F" >F</option>
				</select>
			</div>
		</div>

		{{ Form::label('asociation', trans('messages.tournamentcreate.asociation')) }}
		{{ Form::text('asociation', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
		<div class="row">
			<div class="col-md-6">
				{{ Form::label('city', trans('messages.tournamentcreate.city')) }}
				{{ Form::text('city', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
			</div>
			<div class="col-md-6">
				{{ Form::label('country', trans('messages.tournamentcreate.country')) }}
				{{ Form::text('country', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				{{ Form::label('email', trans('messages.tournamentcreate.email')) }}
				{{ Form::text('email', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
			</div>
			<div class="col-md-6">
				{{ Form::label('phone', trans('messages.tournamentcreate.phone')) }}
				{{ Form::text('phone', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				{{ Form::label('accomday', trans('messages.tournamentcreate.accomday')) }}
				{{ Form::text('accomday', null, array('class' => 'form-control')) }}
			</div>
			<div class="col-md-6">
				{{ Form::label('accomper', trans('messages.tournamentcreate.accomper')) }}
				{{ Form::text('accomper', null, array('class' => 'form-control')) }}
			</div>
		</div>

		{{ Form::label('lunch', trans('messages.tournamentcreate.lunch')) }}
		{{ Form::text('lunch', null, array('class' => 'form-control')) }}
		{{ Form::label('mess', trans('messages.tournamentcreate.mess')) }}
		{{ Form::text('mess', null, array('class' => 'form-control')) }}

 @if (App::environment('production')) 
   <div class="g-recaptcha form-spacing-top" data-sitekey="6Le2kAkUAAAAANHnOicTSKCpX_7uJecvrNdf_jd5"></div>
@endif

		{{ Form::submit(trans('messages.tournamentcreate.register'), array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
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
    $(function() { 
      $('#formreg').submit(function(event){
       var verified = grecaptcha.getResponse();
       if (verified.length === 0){
            event.preventDefault();
       }      
     });
    });
  </script>
@endsection