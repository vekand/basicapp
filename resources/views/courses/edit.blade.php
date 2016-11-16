@extends('main')

@section('title', 'Edit Blog Post')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}
@endsection

@section('content')
<div class="row">
    {!! Form::model($post, ['route' => ['posts.update', $post->id], 'method' => 'PUT']) !!}
    <div class="col-md-8">
        {{ Form::label('title', 'Title:') }}
        {{ Form::text('title', null, ['class' => 'form-control input-lg']) }}

        {{ Form::label('slug', 'Slug:', ['class' => 'form-spacing-top']) }}
        {{ Form::text('slug', null, array('class' => 'form-control', 'required' => '',
        'minlength' => '5','maxlength' => '255')) }}

        {{ Form::label('category_id', 'Category: ', ["class" => 'form-spacing-top']) }}
        {{ Form::select('category_id', $categories, null, ["class" =>'form-control']) }}

        {{ Form::label('tags', 'Tags: ', ["class" => 'form-spacing-top']) }}
        {{ Form::select('tags[]', $tags, null, ["class" =>'select2-multi form-control', 'multiple' => 'multiple']) }}


        {{ Form::label('body', 'Body:', ['class' => 'form-spacing-top']) }}
        {{ Form::textarea('body', null, ['class' => 'form-control']) }}
    </div>
    <div class="col-md-4">
        <div class="well form-spacing-top">
            <div class="dl-horizontal">
                <dt>url:</dt>
                <dd><a href="{{ url('blog/'.$post->slug) }}">{{ url('blog/'.$post->slug) }}</a></dd>
            </div>
            <div class="dl-horizontal">
                <dt>Create at:</dt>
                <dd>{{ date('M j, Y - H:j', strtotime($post->created_at)) }}</dd>
            </div>
            <div class="dl-horizontal">
                <dt>Last updated:</dt>
                <dd>{{ date('M j, Y - H:j', strtotime($post->updated_at))  }}</dd>
            </div>
            <hr>
            <div class="row">
                <div class="col-sm-6">
                    {!! Html::linkRoute('posts.show', 'Cancel', array($post->id), array('class'=>'btn btn-warning btn-block') ) !!}
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
    $(".select2-multi").select2();
    $(".select2-multi").select2().val({!! json_encode($post->tags()->getRelatedIds()) !!}).trigger('change');
</script>
@endsection
