@extends('main')

@section('title', 'Homepage')
@section('stylesheets')
{!! Html::style('css/effect.css') !!}
@endsection
@section('content')

<div class="row" >
<div class="col-md-2 poza1 form-spacing-top" style="margin-left: 5px; height: 450px;">
<a href="{{ $home->site1 }}"><img src="img/sponsor/{{ $home->logo1 }}" class="img-responsive"  title="Sponsor - Logo - Advertisements" alt="" height="85" width="120"></a><br>
<a href="{{ $home->site2 }}"><img src="img/sponsor/{{ $home->logo2 }}" class="img-responsive" title="Sponsor - Logo - Advertisements" alt="sponsor" height="85" width="120"></a><br>
<a href="{{ $home->site3 }}"><img src="img/sponsor/{{ $home->logo3 }}"  title="Sponsor - Logo - Advertisements" class="img-responsive" alt="" height="85" width="120"></a>
 </div>
  <div class="col-md-9">
    <div class="jumbotron form-spacing-top" style="margin-left:25px;">
      <h1 class="text-center">{!! $home->title !!}</h1>
      <p class="lead">{{ substr(strip_tags($home->body), 0, 100) }}{{ strlen(strip_tags($home->body)) > 100 ? '...' : "" }}</p>
      <p><a href="{{ route('popular') }}" class="btn btn-primary btn-lg" href="" role="button">{{ trans('messages.readmore') }}</a>
        @if (Auth::check())
        @if ($user->hasRole('Admin') || $user->hasRole('Super'))
        <a href="{{ route('home.edit', $home->id) }}" class="btn btn-primary btn-lg" role="button" title="Numai pentru profesori / For Teachers only">{{ trans('messages.edit') }}</a>
        @endif
        @endif
      </p>
    </div>
  </div>
</div> <!-- .end of .row -->

{{-- era blog --}}
<div class="row">
 <div class="col-md-2">
  <div class="cuadro_intro_hover " style="background-color:#cccccc;">
    <p style="text-align:center; margin-top:20px;">
      <img src="background/foto13.jpg" class="img-responsive" alt="">
    </p>
    <div class="caption">
      <div class="blur"></div>
      <div class="caption-text">
        <h3 style="border-top:2px solid white; border-bottom:2px solid white; padding:10px;">Login</h3>
        <p>Login</p>
        <a class=" btn btn-default" href="{{ route('login') }}"><span class="glyphicon glyphicon-plus"> Login</span></a>
      </div>
    </div>
  </div>

</div>
<div class="col-md-3">
  <div class="cuadro_intro_hover " style="background-color:#cccccc;">
    <p style="text-align:center; margin-top:20px;">
      <img src="background/foto05.jpg" class="img-responsive" alt="">
    </p>
    <div class="caption">
      <div class="blur"></div>
      <div class="caption-text">
        <h3 style="border-top:2px solid white; border-bottom:2px solid white; padding:10px;">Blog</h3>
        <p>{{ trans('messages.blogs') }}</p>
        <a class=" btn btn-default" href="{{ route('blog') }}"><span class="glyphicon glyphicon-plus"> Blog</span></a>
        {{-- <a class=" btn btn-default" href="{{ route('about', $id) }}"><span class="glyphicon glyphicon-plus"> {{ trans('messages.about') }}</span></a> --}}
      </div>
    </div>
  </div>

</div>
<div class="col-md-3">
  <div class="cuadro_intro_hover " style="background-color:#cccccc;">
    <p style="text-align:center; margin-top:20px;">
      <img src="background/foto11.jpg" class="img-responsive" alt="">
    </p>
    <div class="caption">
      <div class="blur"></div>
      <div class="caption-text">
        <h3 style="border-top:2px solid white; border-bottom:2px solid white; padding:10px;">{{ trans('messages.chess') }}</h3>
        <p>{{ trans('messages.turnee') }}</p>
        @if (Auth::check())
        <a class=" btn btn-default" href="{{ route('tournamentauth') }}"><span class="glyphicon glyphicon-plus"> {{ trans('messages.turneu') }}</span></a>
        @else
        <a class=" btn btn-default" href="{{ route('tournamentguest') }}"><span class="glyphicon glyphicon-plus"> {{ trans('messages.turneu') }}</span></a>
        @endif
        @if (Auth::check())
        <a class=" btn btn-default" href="{{ route('courses.index') }}"><span class="glyphicon glyphicon-plus"> {{ trans('messages.curs') }}</span></a>
        @endif
      </div>
    </div>
  </div>

</div>

<div class="col-md-3 col-md-offset-1 prima text-center" style="color: white;">
 <h2>{{ trans('messages.salut') }}</h2>
 {{ trans('messages.homepage') }}
</div>

<!-- <div class="col-md-3 text-right" style="color: white;">
 <h2>{{ trans('messages.salut') }}</h2>
 {{ trans('messages.homepage') }}
      <video width="350" height="250" controls="controls">
      <source src="{{ asset('/home/'. 'SampleVideo.mp4') }}" type="video/mp4">
      <source src="{{ asset('/home/'. 'SampleVideo.ogg') }}" type="video/ogg">
      <source src="{{ asset('/home/'. 'SampleVideo.webm') }}" type="video/webm">
      </video>
</div> -->
</div>
@endsection 