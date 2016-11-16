@extends('main')

@section('title', 'Edit Blog Post')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
    tinymce.init({
      selector: 'textarea',
      height: 300,
      theme: 'modern',
      plugins: [
      'advlist autolink lists link image charmap print preview hr anchor pagebreak',
      'searchreplace wordcount visualblocks visualchars code fullscreen',
      'insertdatetime media nonbreaking save table contextmenu directionality',
      'emoticons template paste textcolor colorpicker textpattern imagetools'
      ],
      toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
      toolbar2: 'print preview media | forecolor backcolor emoticons',
      image_advtab: true,
      paste_data_images: true,
      object_resizing : "img"
  });
</script>
@endsection

@section('content')

<div class="row">
    {!! Form::model($post, ['files' => true, 'route' => ['posts.update', $post->id], 'method' => 'PUT', 'data-parsley-validate' => '']) !!}
    <div class="col-md-8">
        {{ Form::label('title', 'Title:') }}
        {{ Form::text('title', null, ['class' => 'form-control input-lg']) }}

        <div class="row">
            <div class="col-md-6">
                {{ Form::label('slug', 'Slug:') }}
                {{ Form::text('slug', $post->slug, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' =>'255')) }}
            </div>
            <div class="col-md-3">
                {{ Form::label('vizibil', 'Visible:') }}
                <select class="form-control" name="vizibil"">
                    @if ($post->vizibil == 1)            
                    <option value="1" selected >Visible</option>
                    <option value="0">Non-visible</option> 
                    @else
                    <option value="1">Visible</option>
                    <option value="0" selected >Non-visible</option> 
                    @endif   
                </select>
            </div>
            <div class="col-md-3">
                {{ Form::label('publicu', 'Public:') }}
                <select class="form-control" name="publicu" value=" {{ $post->publicu }}">  
                    @if ($post->publicu == 1)           
                    <option value="1" selected >Public</option>
                    <option value="0">Privat</option> 
                    @else
                    <option value="1" >Public</option>
                    <option value="0" selected >Privat</option> 
                    @endif   
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                {{ Form::label('category_id', 'Category: ', ["class" => 'form-spacing-top']) }}
                {{ Form::select('category_id', $categories, null, ["class" =>'form-control']) }}
            </div>
            <div class="col-md-6">
            {{ Form::label('fisier', 'Image File:') }}
                {{ Form::file('fisier', array('class' => 'form-control', 'data-parsley-max-file-size' => '6000', 'data-parsley-error-message' => 'This file is not ok')) }}
            </div>
        </div>
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
<script type="text/javascript">
window.Parsley.addValidator('maxFileSize', {
  validateString: function(_value, maxSize, parsleyInstance) {
    if (!window.FormData) {
      alert('You are making all developpers in the world cringe. Upgrade your browser!');
      return true;
    }
    var files = parsleyInstance.$element[0].files;
    return files.length != 1  || files[0].size <= maxSize * 1024;
  },
  requirementType: 'integer',
  messages: {
    en: 'This file should not be larger than %s Kb',
    fr: "Ce fichier est plus grand que %s Kb."
  }
});
</script>
@endsection
