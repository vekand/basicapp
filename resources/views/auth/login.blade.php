@extends('main')

@section('title', 'Login')
@section('content')

<div class="row">
    <div class="col-md-6 col-md-offset-3 form-spacing-top jos">
        <h2>Login</h2>
        <hr class="colorgraph"><br>
        {!! Form::open() !!}
        {{ Form::label('email', 'Email:') }}
        {{ Form::email('email', null, ['class' => 'form-control']) }}

        {{ Form::label('password', "Password:") }}
        {{ Form::password('password', ['class' => 'form-control']) }}
       <hr>
        {{ Form::checkbox('remember') }} {{ Form::label('remember', "Remember") }}
        <p class = "pull-right"><a href="{{ url('password/reset') }}" > Forgot Your Password ?</a></p>

        {{ Form::submit('Login', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}

        {!! Form::close() !!}
    </div>
</div>

@endsection