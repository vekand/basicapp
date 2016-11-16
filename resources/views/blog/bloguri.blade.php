@extends('main')

@section('title', 'Blogs')
@section('stylesheets')
{!! Html::style('css/blog.css') !!}

@endsection
@section('content')
<div class="row">
  <div class="col-md-6 label label-default jos" style="opacity:0.9;">
    {{-- <h1>{{ trans('messages.blog.blogprof') }}</h1> --}}
    <h3>{{ trans('messages.blog.activity') }}</h3>
  </div>
  <div class="col-md-6 label label-default jos" style="opacity:0.9;">
    <h3>{{ trans('messages.blog.cli') }}</h3>
    <p></p>
  </div>
</div>
<div class="row">
  <div class="col-md-6">
 
    <!-- artigo em destaque -->
    <div class="featured-article">
      <a href="#">
        {{-- <img src="http://placehold.it/482x350" alt="" class="thumb"> --}}
        <img src="background/foto20.jpg" alt="" class="thumb" width="482" height="350"> 
      </a>
      <div class="block-title">
        <h2>{{ trans('messages.blog.activi') }}</h2>
        <p class="by-author"><small>By Admin</small></p>
      </div>
    </div>
    <!-- /.featured-article -->
  </div>
  <div class="col-md-6">
    <ul class="media-list main-list">
    @foreach ($profi as $prof)
    @if ($prof->blog == 1)
      <li class="media">
       <div class="col-md-8">
        <a class="pull-left" href="{{ route('blogpart', $prof->id) }}">
          <img class="media-object" src="background/foto21.jpg" alt="..." width="150" height="90">
        </a>
        <div class="media-body">
          <h3 class="media-heading">&nbsp;{{ $prof->nick_name }}</h3>
          <p class="by-author">By {{ $prof->nick_name }}</p>
        </div>
      </div>
      <div class="col-md-4">
        <div class="media-body">
          <h4 class="media-heading"><a class="pull-left label label-default" href="{{ route('about', $prof->id) }}">{{ trans('messages.about') }}
          </a></h4>
        </div>
      </div>
    </li>
    @endif
    @endforeach
 
</ul>
</div>
</div>
@endsection
