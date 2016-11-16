@extends('main')

@section('title', 'Tournament')

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
		SRC="{{ $tournament->chesssite }}"
		title="{{ $tournament->descriere }}" > Your browser does not support inline frames or is currently configured not to display inline frames. 
		</IFRAME>
	</div>
</div>
@endsection