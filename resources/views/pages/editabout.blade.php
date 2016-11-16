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
 {!! Form::model($about, ['files' => true, 'route' => ['about.update', $about->id], 'method' => 'PUT']) !!}
 {{ Form::hidden('profid', $about->prof_id) }}
 <div class="col-md-10 col-md-offset-1 jos">
  {{ Form::label('title', 'Title:') }}
  {{ Form::text('title', null, ['class' => 'form-control input-lg']) }}
  <div class="row">
    <div class="col-md-6">
      {{ Form::label('foto1', trans('messages.courses.file')) }}
      {{ Form::file('foto1', array('class' => 'form-control')) }}
    </div>

    <div class="col-md-6">
      {{ Form::label('foto2', trans('messages.courses.file')) }}
      {{ Form::file('foto2', array('class' => 'form-control')) }}
    </div>
   </div> 
    <div class="row">
     <div class="col-md-6">
      {{ Form::label('foto3', trans('messages.courses.file')) }}
      {{ Form::file('foto3', array('class' => 'form-control')) }}
    </div>
    <div class="col-md-6">
      {{ Form::label('foto4', trans('messages.courses.file')) }}
      {{ Form::file('foto4', array('class' => 'form-control')) }}
    </div>
  </div>
  <div class="row">
    <div class="col-md-6">
      {{ Form::label('foto5', trans('messages.courses.file')) }}
      {{ Form::file('foto5', array('class' => 'form-control')) }}
    </div>
  </div>   
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
@endsection
