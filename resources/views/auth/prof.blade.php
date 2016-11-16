@extends('main')

@section('title', 'Prof')
@section('stylesheets')
{!! Html::style('css/parsley.css') !!}


@endsection
@section('content')
<div class="row">

  <div class="col-md-6 col-md-offset-3 form-spacing-top jos">
    <h2>Register Teacher/ Profesor - page 2/2 </h2>
    <hr class="colorgraph"><br>
    {!! Form::open(['route' => 'profregister', 'id' => 'formregister', 'method' => 'PUT', 'data-parsley-validate' => '']) !!}

    {{ Form::label('adresa', "Adresa/ Address (user):") }}
    {{ Form::text('adresa', 'local', ['class' => 'form-control', 'required' => '']) }}

    {{ Form::label('oras', "Oras/ City (user):") }}
    {{ Form::text('oras', 'local', ['class' => 'form-control', 'required' => '']) }}
    {{ Form::label('scoala', "Scoala /School (user):") }}
    {{ Form::text('scoala', 'local', ['class' => 'form-control', 'required' => '' ]) }}

     {{ Form::label('prof_id', 'Apartine de: Profesor / Belongs to: Teacher') }}
    <select class="form-control" name="prof_id" required="required">
      <option value=""></option>
      @foreach($profs as $prof)
      <option value="{{ $prof->id }}">{{ $prof->first_name.' '.$prof->last_name }}</option>
      @endforeach
    </select>
    {{-- <div class="g-recaptcha form-spacing-top" data-sitekey="6Lew-yUTAAAAAN_ze7WWnumoSS_7EZ_38UOK4vx_"></div> --}}

    {{ Form::submit('Save Profesor / Teacher', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}
    {!! Form::close() !!}
  </div>
</div>
<script type="text/javascript">
   /* $(function() { 
      $('#formregister').submit(function(event){
       var verified = grecaptcha.getResponse();
       if (verified.length === 0){
            event.preventDefault();
       }      
     });
   });*/
 </script>
 @endsection
 @section('scripts')
 {!! Html::script('js/parsley.min.js') !!}
 <script type="text/javascript">
 </script>

 @endsection


