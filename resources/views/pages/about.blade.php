@extends('main')

@section('title', 'About')
@section('stylesheets')
{!! Html::style('css/about.css') !!}
@endsection

@section('content')

<div class="row singleabout">
	<div class="col-md-8">
		<h1>{{ $about->title }}</h1>
		<p>{!! $about->body !!}</p>
	</div>
	<div class="col-md-3 col-md-offset-1">
		<div class="well form-spacing-top">
			<h3><small>{{ $prof->last_name.' '.$prof->first_name }}</small></h3>

			<!-- <div class="media">
				<div class="media-body">
					<iframe width="560" height="315" src={{ $about->title + "&output=embed" }} frameborder="0" allowfullscreen>
					</iframe>
				</div>
			</div> -->
			@if (Auth::check() && (Auth::user()->prof_id == $prof->id || Auth::user()->prof_id == 1))
			@if ($user->hasRole('Author') || $user->hasRole('Admin') || $user->hasRole('Super'))
			<h2><a href="{{ route('about.edit', $about->id) }}" class="btn btn-lg btn-blog btn-primary btn-h1-spacing" title="Numai pentru profesori / For Teachers only">{{ trans('messages.edit') }}</a></h2>
			@endif
			@endif
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6" >
		<div class="carousel slide article-slide form-spacing-top" id="article-photo-carousel">

			<!-- Wrapper for slides -->
			<div class="carousel-inner cont-slider">

				<div class="item active">
					<img alt="" title="" src="{{ URL::to('img/'.$about->prof_id.'/foto11.jpg') }}">
				</div>
				<div class="item">
					<img alt="" title="" src="{{ URL::to('img/'.$about->prof_id.'/foto12.jpg') }}">
				</div>
				<div class="item">
					<img alt="" title="" src="{{ URL::to('img/'.$about->prof_id.'/foto13.jpg') }}">
				</div>
				<div class="item">
					<img alt="" title="" src="{{ URL::to('img/'.$about->prof_id.'/foto14.jpg') }}">
				</div>
			</div>
			<!-- Indicators -->
			<ol class="carousel-indicators">
				<li class="active" data-slide-to="0" data-target="#article-photo-carousel">
					<img alt="" src="{{ URL::to('img/'.$about->prof_id.'/foto11.jpg') }}">
				</li>
				<li class="" data-slide-to="1" data-target="#article-photo-carousel">
					<img alt="" src="{{ URL::to('img/'.$about->prof_id.'/foto12.jpg') }}">
				</li>
				<li class="" data-slide-to="2" data-target="#article-photo-carousel">
					<img alt="" src="{{ URL::to('img/'.$about->prof_id.'/foto13.jpg') }}">
				</li>
				<li class="" data-slide-to="3" data-target="#article-photo-carousel">
					<img alt="" src="{{ URL::to('img/'.$about->prof_id.'/foto14.jpg') }}">
				</li>
			</ol>
		</div>
	</div>
	<div class="col-md-5 col-md-offset-1 form-spacing-top jos" >
		<div class="item active">
			<img alt="" title="" src="{{ URL::to('img/'.$about->prof_id.'/foto15.jpg') }}" height="400" width="450">
		</div>
	</div>     
</div>      



@endsection

@section('scripts')
{!! Html::script('js/parsley.min.js') !!}
{!! Html::script('js/select2.min.js') !!}
<script type="text/javascript">
	// Stop carousel
	$('.carousel').carousel({
		interval: 4000
	});
</script>
@endsection