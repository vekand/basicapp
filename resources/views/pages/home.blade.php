@extends('main')

@section('title', 'Home')

@section('content')

<div class="row">
	<div class="col-md-10 col-md-offset-1 sus">
		{{-- <div class="col-md-8"> --}}
		
		@if ($home->foto1)
				@if (substr($home->foto1, -4) == '.pdf')
	<iframe src="{{ asset('/home/'. $home->foto1) }}" title="pdf" align="top" height="620" width="100%" frameborder="0" scrolling="auto" target="Pdf">
	</iframe>
	@endif
	@if (substr($home->foto1, -4) == '.jpg' || substr($home->foto1, -4) == '.jpeg' || substr($home->foto1, -4) == '.png' || substr($home->foto1, -4) == '.gif')
	<img src="{{ asset('/home/'. $home->foto1) }}" style="max-width:600px; max-height:400px;" >
	@endif
	@if (substr($home->foto1, -4) == '.mp4')
	<video width="320" height="300" controls="controls">
	<source src="{{ asset('/home/'. $home->foto1) }}" type="video/mp4">					
	</video>
	@endif
	@if (substr($home->foto1, -4) == '.3gp')
	<video width="320" height="300" controls="controls">
	<source src="{{ asset('/home/'. $home->foto1) }}" type="video/3gpp">			
	</video>
	@endif
	@if (substr($home->foto1, -4) == '.avi')
	<video width="320" height="300" controls="controls">
	<source src="{{ asset('/home/'. $home->foto1) }}" type="x-msvideo">			
	</video>
	@endif
		@endif
		<h1>{!! $home->title !!}</h1>
		<hr>
		<p>{!! $home->body !!}</p>
		<hr>
		{{-- </div>		 --}}
		<div  class="col-md-3 col-md-offset-1">
			<video width="320" height="300" controls="controls">
				<source src="{{ asset('/home/'. 'SampleVideo.mp4') }}" type="video/mp4">
					<source src="{{ asset('/home/'. 'SampleVideo.ogg') }}" type="video/ogg">
						<source src="{{ asset('/home/'. 'SampleVideo.webm') }}" type="video/webm">
						</video>
					</div>
					
				</div>
			</div>
			@endsection