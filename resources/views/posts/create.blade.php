@extends('main')

@section('title', 'New Post')

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
		'emoticons template paste textcolor colorpicker textpattern imagetools save'
		],
		toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
		toolbar2: 'print preview media | forecolor backcolor emoticons save',
		image_advtab: true,
		paste_data_images: true,
		object_resizing : "img"
	});
</script>
@endsection

@section('content')

<div class="row">
	<div class="col-md-8 col-md-offset-2 jos">
		<h1>Create New Post</h1>
		<hr>
		{!! Form::open(array('files' => true, 'route' => 'posts.store', 'data-parsley-validate' => '')) !!}
		{{ Form::label('title', 'Title:') }}
		{{ Form::text('title', null, array('class' => 'form-control', 'required' => '', 'maxlength' => '255')) }}
		<div class="row">
			<div class="col-md-6">
				{{ Form::label('slug', 'Slug:') }}
				{{ Form::text('slug', null, array('class' => 'form-control', 'required' => '', 'minlength' => '5', 'maxlength' =>'255')) }}
			</div>
			<div class="col-md-3">
				{{ Form::label('vizibil', 'Visible:') }}
				<select class="form-control" name="vizibil">			
					<option value="1" selected="selected">Visible</option>
					<option value="0">Non-visible</option>	
				</select>
			</div>
			<div class="col-md-3">
				{{ Form::label('publicu', 'Public:') }}
				<select class="form-control" name="publicu">			
					<option value="1"  selected="selected">Public</option>
					<option value="0">Privat</option>	
				</select>
			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
				{{ Form::label('category_id', 'Category:') }}
				<select class="form-control" name="category_id">
					@foreach($categories as $category)
					<option value="{{ $category->id }}">{{ $category->name }}</option>
					@endforeach
				</select>
			</div>
			<div class="col-md-6">
				{{ Form::label('fisier', 'File:') }}
				{{ Form::file('fisier', array('class' => 'form-control', 'data-parsley-max-file-size' => '6000', 'data-parsley-error-message' => 'This file is not ok')) }}
			</div>
		</div>

		{{ Form::label('tags', 'Tags:') }}
		<select class="select2-multi form-control" name="tags[]" multiple="multiple">
			@foreach($tags as $tag)
			<option value="{{ $tag->id }}">{{ $tag->name }}</option>
			@endforeach
		</select>

		{{ Form::label('body', 'Post Body:') }}
		{{ Form::textarea('body', null, array('class' => 'form-control')) }}

		{{ Form::submit('Create Post', array('class' => 'btn btn-success btn-lg btn-block', 'style' => 'margin-top: 20px;')) }}
		{!! Form::close() !!}
	</div>
</div>
@endsection

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}
<script type="text/javascript">
	  $(".select2-multi").select2();  //plugin
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