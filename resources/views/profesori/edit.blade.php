@extends('main')

@section('title', 'Edit Tournament')

@section('stylesheets')

@endsection

@section('content')
<div class="row">
<div class="col-md-6 col-md-offset-3 jos">
<h1>{{ trans('messages.profesori.edit') }} <small>{{ $prof->nick_name }}</small></h1>
    {!! Form::model($prof, ['files' => true, 'route' => ['profesori.update', $prof->id], 'method' => 'PUT']) !!}
      {{ Form::label('first_name', "First_Name:") }}
        {{ Form::text('first_name', $prof->first_name, ['class' => 'form-control', 'required' => '', 'maxlength' => '255']) }}

        {{ Form::label('last_name', "Last_Name:") }}
        {{ Form::text('last_name', $prof->last_name, ['class' => 'form-control',  'required' => '', 'maxlength' => '255']) }}

        {{ Form::label('nick_name', "Nick_name:") }}
        {{ Form::text('nick_name', $prof->nick_name, ['class' => 'form-control',  'required' => '', 'maxlength' => '255']) }}

        {{ Form::label('email', "Email:") }}
        {{ Form::text('email', $prof->email, ['class' => 'form-control']) }}

        {{ Form::label('adresa', "Adresa:") }}
        {{ Form::text('adresa', $prof->adresa, ['class' => 'form-control']) }}

        {{ Form::label('oras', "Oras:") }}
        {{ Form::text('oras', $prof->oras, ['class' => 'form-control']) }}

        {{ Form::label('scoala', "Scoala:") }}
        {{ Form::text('scoala', $prof->scoala, ['class' => 'form-control']) }}

        {{ Form::label('activ', "Activ:") }}
        {{ Form::text('activ', $prof->activ, ['class' => 'form-control',  'required' => '', 'maxlength' => '1']) }}

        {{ Form::label('blog', "Blog:") }}
        {{ Form::text('blog', $prof->blog, ['class' => 'form-control',  'required' => '', 'maxlength' => '1']) }}

        {{ Form::label('text', "Text:") }}
        {{ Form::text('text', $prof->text, ['class' => 'form-control',  'required' => '', 'maxlength' => '255']) }}

        {{ Form::submit('Save', ['class' => 'btn btn-primary btn-block form-spacing-top']) }}
        {!! Form::close() !!}
</div>
</div>
@endsection

@section('scripts')

@endsection
