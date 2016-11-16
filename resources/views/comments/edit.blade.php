@extends('main')

@section('title', 'Edit Comment')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')

<div class="row">
    <div id="comment-form" class="col-md-10 col-md-offset-1">
        <h1>{{ trans('messages.comments.edit') }}</h1>
        <hr>
        {!! Form::model($comment, ['route' => ['comments.update', $comment->id], 'method' => 'PUT',  'data-parsley-validate' => '']) !!}
        <div class="col-md-8 col-md-offset-2 form-spacing-top jos">
            <div class="row">
                <div class="col-md-6">
                    {{ Form::label('name', trans('messages.comments.name')) }}
                    {{ Form::text('name', $comment->name, ['class' => 'form-control', 'disabled' => '', 'maxlength' => '255']) }}
                </div>
                <div class="col-md-6">
                    {{ Form::label('email', trans('messages.comments.email')) }}
                    {{ Form::text('email', $comment->email, ['class' => 'form-control', 'disabled' => '', 'maxlength' => '255']) }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ Form::label('comment', trans('messages.comments.comment')) }}
                    {{ Form::textarea('comment', $comment->comment, ['class' => 'form-control', 'required' => '','maxlength' => '1000', 'rows' => '5']) }}
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    {{ Form::submit(trans('messages.comments.save'), ['class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;']) }}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}
<script type="text/javascript">
    $(".select2-multi").select2();

</script>
@endsection
