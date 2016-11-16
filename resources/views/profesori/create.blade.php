@extends('main')

@section('title', 'New Teacher')

@section('stylesheets')

@endsection

@section('content')
<div class="row">
	<div class="col-md-6 col-md-offset-3 jos">
		<h1>{{ trans('messages.profesori.newprof') }}</h1>
		<hr>
	     {!! Form::open(['route' => 'profesori.store', 'id' => 'formregister']) !!}

        {{ Form::label('first_name', "First_Name:") }}
        {{ Form::text('first_name', null, ['class' => 'form-control']) }}

        {{ Form::label('last_name', "Last_Name:") }}
        {{ Form::text('last_name', null, ['class' => 'form-control']) }}

        {{ Form::label('nick_name', "Nick_name:") }}
        {{ Form::text('nick_name', null, ['class' => 'form-control']) }}

        {{ Form::label('email', "Email:") }}
        {{ Form::text('email', null, ['class' => 'form-control']) }}

        {{ Form::label('adresa', "Adresa:") }}
        {{ Form::text('adresa', null, ['class' => 'form-control']) }}

        {{ Form::label('oras', "Oras:") }}
        {{ Form::text('oras', null, ['class' => 'form-control']) }}

        {{ Form::label('scoala', "Scoala:") }}
        {{ Form::text('scoala', null, ['class' => 'form-control']) }}

        {{ Form::label('activ', "Activ:") }}
        {{ Form::text('activ', null, ['class' => 'form-control']) }}

        {{ Form::label('blog', "Blog:") }}
        {{ Form::text('blog', null, ['class' => 'form-control']) }}

        {{ Form::label('text', "Text:") }}
        {{ Form::text('text', null, ['class' => 'form-control']) }}

        {{ Form::submit('Add new Teacher', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}
        {!! Form::close() !!}
	</div>
</div>
@endsection

@section('scripts')

@endsection