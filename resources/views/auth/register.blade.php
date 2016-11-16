@extends('main')

@section('title', 'Register')

@section('content')
<div class="row">

    <div class="col-md-6 col-md-offset-3 form-spacing-top jos">
        <h2>Register user - page 1/2</h2>
        <hr class="colorgraph"><br>
        {!! Form::open(['route' => 'postregister', 'id' => 'formregister']) !!}

        {{ Form::label('first_name', "First_Name:") }}
        {{ Form::text('first_name', null, ['class' => 'form-control']) }}

        {{ Form::label('last_name', "Last_Name:") }}
        {{ Form::text('last_name', null, ['class' => 'form-control']) }}

        {{ Form::label('email', 'Email:') }}
        {{ Form::email('email', null, ['class' => 'form-control']) }}

        {{ Form::label('password', "Password:") }}
        {{ Form::password('password', ['class' => 'form-control']) }}

        {{ Form::label('password_confirmation', "Confirm Password:") }}
        {{ Form::password('password_confirmation', ['class' => 'form-control']) }}
@if (App::environment('production')) 
   <div class="g-recaptcha form-spacing-top" data-sitekey="6Le2kAkUAAAAANHnOicTSKCpX_7uJecvrNdf_jd5"></div>
@endif
        {{ Form::submit('Register', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}
        {!! Form::close() !!}
    </div>
</div>
 <script type="text/javascript">
    $(function() { 
      $('#formregister').submit(function(event){
       var verified = grecaptcha.getResponse();
       if (verified.length === 0){
            event.preventDefault();
       }      
     });
    });
  </script>
@endsection


