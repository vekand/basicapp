@extends('main')

@section('title', 'Edit Course')

@section('stylesheets')
{!! Html::style('css/parsley.css') !!}
{!! Html::style('css/select2.min.css') !!}
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>
<script>
 var editor_config = {
  path_absolute : "{{  URL::to('/') }}/",
  selector: "textarea",
  height: 600,
  theme: 'modern',
  paste_data_images: true,
  plugins: [
  "advlist autolink lists link image charmap print preview hr anchor pagebreak",
  "searchreplace wordcount visualblocks visualchars code fullscreen",
  "insertdatetime media nonbreaking save table contextmenu directionality",
  "emoticons template paste textcolor colorpicker textpattern code textcolor"
  ],
  toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image media forecolor backcolor",
  relative_urls: false,
  file_browser_callback : function(field_name, url, type, win) {
    var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
    var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

    var cmsURL = editor_config.path_absolute + 'laravel-filemanager?field_name=' + field_name;
    if (type == 'image') {
      cmsURL = cmsURL + "&type=Images";
    } else {
      cmsURL = cmsURL + "&type=Files";
    }

    tinyMCE.activeEditor.windowManager.open({
      file : cmsURL,
      title : 'Filemanager',
      width : x * 0.8,
      height : y * 0.8,
      resizable : "yes",
      close_previous : "no"
    });
  }
};

tinymce.init(editor_config);
</script>
@endsection

@section('content')

{!! Form::open(['route' => ['courses.savehtml', $course->id], 'method' => 'POST']) !!}
<div class="row">
  <div class="col-md-9">
    <h1>{{ $course->tipcurs }}</h1>
  </div>
  <div class="col-sm-2 col-offset-1 sus">

    {!! Form::submit('Save to HTML', ['class' => 'btn btn-success btn-block text-right']) !!}

  </div>

</div>  
<textarea id="edit_content" class="content" name='content' width: 100%; height:100%;">
{!! $tml !!}
</textarea>
{!! Form::close() !!}
@endsection

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}
<script type="text/javascript">

</script>
@endsection
