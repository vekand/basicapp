@extends('main')

@section('title', 'Blogs')

@section('content')
<div class="row blogger">
    <div class="col-md-4 col-md-offset-2">
        <h1>Blog <small>{{ $prof->nick_name }}</small></h1>
    </div>
       <div class="col-md-4 col-md-offset-2 label label-default josfara">
       <a href="{{ route('about', $id) }}"> <h2>{{ trans('messages.about') }}</h2></a>
       
    </div>
</div>

@foreach($posts as $post)
@if ($post->publicu == 1)
<div class="row posts">
    <div class="col-md-8 col-md-offset-2 post">
        <h2>{{ $post->title }}</h2>
        <h5>Published: {{ date('M j, Y G:i', strtotime($post->created_at)) }}</h5>
        <p>{{ substr(strip_tags($post->body), 0, 250) }}{{ strlen(strip_tags($post->body)) > 250 ? '...' : "" }}</p>
        <a  class="btn btn-primary" href="{{ route('blog.single', $post->slug) }}">{{ trans('messages.readmore') }}</a>
        <hr>
    </div>
</div>
@else
    @if (Auth::check() && Auth::user()->prof_id == $post->prof_id)
    <div class="row posts">
    <div class="col-md-8 col-md-offset-2 post">
        <h2>{{ $post->title }}</h2>
        <h5>Published: {{ date('M j, Y G:i', strtotime($post->created_at)) }}</h5>
        <p>{{ substr(strip_tags($post->body), 0, 250) }}{{ strlen(strip_tags($post->body)) > 250 ? '...' : "" }}</p>
        <a  class="btn btn-primary" href="{{ route('blog.single', $post->slug) }}">{{ trans('messages.readmore') }}</a>
        <hr>
    </div>
    </div>
    @endif
@endif
@endforeach

<div clas="text-center">
    @if ($paginate==true)
    {!! $posts->links() !!}
    @endif      
</div>

@endsection
