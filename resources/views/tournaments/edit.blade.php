@extends('main')

@section('title', 'Edit Tournament')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}
{!! Html::style('css/datepicker.css') !!}
@endsection

@section('content')
<div class="row">
<h1>{{ trans('messages.tournamentcreate.edit') }} <small>{{ $tournament->descriere }}</small></h1>
    {!! Form::model($tournament, ['files' => true, 'route' => ['tournaments.update', $tournament->id], 'method' => 'PUT']) !!}
    <div class="col-md-8 jos">
        {{ Form::label('descriere', trans('messages.tournamentcreate.description')) }}
        {{ Form::text('descriere', $tournament->descriere, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
        <div class="row">
            <div class="col-md-6">
                {{ Form::label('prospect', trans('messages.tournamentcreate.file')) }}
                {{ Form::file('prospect', array('class' => 'form-control')) }}
            </div>
            <div class="col-md-6">
                {{ Form::label('posted_at', trans('messages.tournamentcreate.posted_at')) }}
                {{ Form::text('posted_at', $tournament->posted_at , array('id' => 'datepicker', 'class' => 'form-control datepicker', 'required' => '')) }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                {{ Form::label('slug', 'Slug:') }}
                {{ Form::text('slug', $tournament->slug, array('class' => 'form-control', 'required' => '', 'minlength' => '3', 'maxlength' =>'20')) }}
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                {{ Form::label('nrrunde', trans('messages.tournamentcreate.rounds')) }}
                {{ Form::input('number','nrrunde', $tournament->nrrunde, array('class' => 'form-control', 'required' => '')) }}
            </div>
        </div> 
        
        {{ Form::label('perioada', trans('messages.tournamentcreate.period')) }}
        {{ Form::text('perioada', $tournament->perioada, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}

        <div class="row">
            <div class="col-md-6">
                {{ Form::label('localit', trans('messages.tournamentcreate.city')) }}
                {{ Form::text('localit', $tournament->localit, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
            </div> 
            <div class="col-md-6">
                {{ Form::label('tara', trans('messages.tournamentcreate.country')) }}
                {{ Form::text('tara', $tournament->tara, array('class' => 'form-control', 'maxlength' => '255')) }}
            </div> 
        </div> 
        <div class="row">
            <div class="col-md-6">
                {{ Form::label('stare', trans('messages.tournamentcreate.status')) }}
                {{ Form::text('stare', $tournament->stare, array('class' => 'form-control', 'maxlength' => '255')) }}
            </div>
            <div class="col-md-6">
                {{ Form::label('obs', trans('messages.tournamentcreate.remarqs')) }}
                {{ Form::text('obs', $tournament->obs, array('class' => 'form-control', 'maxlength' => '255')) }}
            </div> 
        </div> 
        

        {{ Form::label('chesssite', trans('messages.tournamentcreate.chessresult')) }}
        {{ Form::text('chesssite', $tournament->chesssite, array('class' => 'form-control', 'maxlength' => '255')) }}
    </div>
    <div class="col-md-4">
        <div class="well form-spacing-top">
            <div class="dl-horizontal">
                <dt>url:</dt>
                <p><a href="{{ route('chessresult', $tournament->id) }}">{{ url($tournament->chesssite)  }}</a></p>
            </div>
            <div class="dl-horizontal">
                <dt>Create at:</dt>
                <dd>{{ date('M j, Y - H:j', strtotime($tournament->created_at)) }}</dd>
            </div>
            <div class="dl-horizontal">
                <dt>Last updated:</dt>
                <dd>{{ date('M j, Y - H:j', strtotime($tournament->updated_at))  }}</dd>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('tournaments.show', 'Cancel', array($tournament->id), array('class'=>'btn btn-warning btn-block') ) !!}
                </div>
                <div class="col-sm-6">
                    {!! Form::submit('Save Changes',['class'=>'btn btn-success btn-block'] ) !!}
                    {{-- {!! Html::linkRoute('posts.update', 'Save Changes', array($post->id), array('class'=>'btn btn-success btn-block')) !!}--}}
                    {{--    <a href="#" class="btn btn-danger btn-block">Delete</a>--}}
                </div>
            </div>
        </div>
    </div>
    {!! Form::close() !!}
</div>
@endsection

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}
<script type="text/javascript">
    $( function() {
        $( "#datepicker" ).datepicker({ dateFormat: 'yy-mm-dd' });
    } );
</script>
@endsection
