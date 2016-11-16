@extends('main')

@section('title', 'Contact')

@section('content') 
<div class="row">
  <div class="col-md-6 col-md-offset-3 form-spacing-top jos">
    <h2>Contact me</h2>
    <hr class="colorgraph"><br>
        {!! Form::open(array('route' => 'contact', 'id' => 'formcontact')) !!}
        {{ Form::label('email', 'Your Email:') }}
        {{ Form::email('email', null, ['class' => 'form-control', 'method' => 'POST']) }}

        {{ Form::label('subject', "subject:") }}
        {{ Form::text('subject', null, array('class' => 'form-control', 'required' => '', 'minlength' => '2', 'maxlength' =>'25')) }}

        {{ Form::label('message', 'Message:') }}
        {{ Form::textarea('message', null, array('class' => 'form-control', 'required' => '')) }}

 <div class="g-recaptcha form-spacing-top" data-sitekey="6Lew-yUTAAAAAN_ze7WWnumoSS_7EZ_38UOK4vx_"></div>

        {{ Form::submit('Send message', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}

        {!! Form::close() !!}
  </div>
</div>
<script type="text/javascript">
    $(function() { 
      $('#formcontact').submit(function(event){
       var verified = grecaptcha.getResponse();
       if (verified.length === 0){
            event.preventDefault();
       }      
     });
    });
  </script>
@endsection
