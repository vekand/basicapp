@extends('main')

@section('title', 'Play')

@section('content')

<div class="row">
	<div class="col-md-12">
		<IFRAME 
		height="900px" 
		width="900px" 
		align="left" 
		frameborder="0" 
		marginwidth="1" 
		marginheight ="1" 
		scrolling="auto"
		SRC="{{ $course->gameeditor }}"
		title="{{ $course->tipcurs }}" > Your browser does not support inline frames or is currently configured not to display inline frames. 
		</IFRAME>
	</div>
</div>
@endsection