@extends('main')

@section('title', 'Edit About me')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
  tinymce.init({
    selector: 'textarea',
    height: 300,
    theme: 'modern',
    paste_data_images: true,
    plugins: [
    'advlist autolink lists link image charmap print preview hr anchor pagebreak',
    'searchreplace wordcount visualblocks visualchars code fullscreen',
    'insertdatetime media nonbreaking save table contextmenu directionality',
    'emoticons template paste textcolor colorpicker textpattern imagetools'
    ],
    toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
    toolbar2: 'print preview media | forecolor backcolor emoticons',
    image_advtab: true,
    object_resizing : "img"
  });
</script>
@endsection

@section('content')

<div class="row">
 {!! Form::model($home, ['files' => true, 'route' => ['home.update', $home->id], 'method' => 'PUT', 'data-parsley-validate' => '']) !!}
 <div class="col-md-10 col-md-offset-1 jos">
  {{ Form::label('title', 'Title:') }}
  {{ Form::text('title', null, ['class' => 'form-control input-lg']) }}
  <div class="row">
    <div class="col-md-6">
      {{ Form::label('foto1', trans('messages.courses.file')) }}
      {{ Form::file('foto1', array('class' => 'form-control', 'data-parsley-max-file-size' => '6000', 'data-parsley-error-message' => 'This file is not ok')) }}
    </div>
    <div class="col-md-6">
     {{ Form::label('delfoto', 'Delete photo') }}
     {{ Form::checkbox('delfoto') }}
   </div>
 </div>
<div class="row">
    <div class="col-md-6">
      {{ Form::label('logo1', 'Logo1:') }}
      {{ Form::file('logo1', array('class' => 'form-control')) }}
    </div>
    <div class="col-md-6">
    {{ Form::label('site1', 'Site1:') }}
    {{ Form::text('site1', $home->site1, ['class' => 'form-control input-md', 'placeholder' => 'http://']) }}
     </div>
    <div class="col-md-6">
     {{ Form::label('logo2', 'Logo2:') }}
      {{ Form::file('logo2', array('class' => 'form-control')) }}
   </div>
   <div class="col-md-6">
    {{ Form::label('site12', 'Site2:') }}
    {{ Form::text('site2', $home->site2, ['class' => 'form-control input-md', 'placeholder' => 'http://']) }}
     </div>
    <div class="col-md-6">
     {{ Form::label('logo3', 'Logo3:') }}
      {{ Form::file('logo3', array('class' => 'form-control')) }}
   </div>
     <div class="col-md-6">
    {{ Form::label('site13', 'Site3:') }}
    {{ Form::text('site3', $home->site3, ['class' => 'form-control input-md', 'placeholder' => 'http://']) }}
     </div>
 </div>

 <!--   <div class="row">
   <div class="col-md-6">
  {{ Form::label('foto2', trans('messages.courses.file')) }}
  {{ Form::file('foto2', array('class' => 'form-control')) }}
   </div>
 <div class="col-md-6">
  {{ Form::label('foto3', trans('messages.courses.file')) }}
  {{ Form::file('foto3', array('class' => 'form-control')) }}

   </div>
 </div>   
   <div class="row">
   <div class="col-md-6">
  {{ Form::label('foto4', trans('messages.courses.file')) }}
  {{ Form::file('foto4', array('class' => 'form-control')) }}
   </div>
   <div class="col-md-6">
  {{ Form::label('foto5', trans('messages.courses.file')) }}
  {{ Form::file('foto5', array('class' => 'form-control')) }}
   </div>
 </div>    -->


 {{ Form::label('body', 'Body:', ['class' => 'form-spacing-top']) }}
 {{ Form::textarea('body', null, ['class' => 'form-control']) }}

 {!! Form::submit('Save Changes',['class'=>'btn btn-success btn-block form-spacing-top'] ) !!}
</div>
</div>
@endsection

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}
<script type="text/javascript">

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
