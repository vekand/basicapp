@extends('main')
@section('title', 'Chess')
@section('stylesheets')
{!! Html::style('css/carousel.css') !!}
@endsection
@section('content')
<div class="container">
    <div id="main_area">
        <!-- Slider -->
        <div class="row">
            <div class="col-md-12 sus" id="slider">
                <!-- Top part of the slider -->
                <div class="row">
                    <div class="col-sm-8" id="carousel-bounding-box">
                        <div class="carousel slide" id="myCarousel">
                            <!-- Carousel items -->
                            <div class="carousel-inner">
                                @foreach ($carousels as $carousel)
                                @if ($carousel->id == 1)
                                <div class="active item" data-slide-number="0">
                               
                                    <img src="img/foto01.jpg"></div>
                                    @endif    
                                    @if ($carousel->id == 2)
                                    <div class="item" data-slide-number="1">
                                     <img src="img/foto02.jpg"></div>
                                        @endif 
                                        @if ($carousel->id == 3)
                                        <div class="item" data-slide-number="2">
                                         <img src="img/foto03.jpg"></div>
                                            @endif 
                                            @if ($carousel->id == 4)
                                            <div class="item" data-slide-number="3">
                                                <img src="img/foto04.jpg"></div>
                                                @endif 
                                                @if ($carousel->id == 5)
                                                <div class="item" data-slide-number="4">
                                                    <img src="img/foto05.jpg"></div>
                                                    @endif 
                                                    @if ($carousel->id == 6)
                                                    <div class="item" data-slide-number="5">
                                                        <img src="img/foto06.jpg"></div>
                                                        @endif 
                                                        @endforeach      
                                                    </div><!-- Carousel nav -->
                                                    <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                                        <span class="glyphicon glyphicon-chevron-left"></span>                                       
                                                    </a>
                                                    <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                                        <span class="glyphicon glyphicon-chevron-right"></span>                                       
                                                    </a>                                
                                                </div>
                                            </div>

                                            <div class="col-sm-4" id="carousel-text"></div>

                                            <div id="slide-content" style="display: none;">
                                             @foreach ($carousels as $carousel)
                                             @if ($carousel->id == 1)
                                             <div id="slide-content-0">
                                                <h2>{{ $carousel->title }}</h2>
                                                <p>{{ $carousel->body }}</p>
                                                <p class="sub-text">{{ date('M j, Y', strtotime($carousel->updated_at)) }} - <a href="#">{{ $carousel->readmore }}</a></p>
                                                <hr><hr>
                                                @if (Auth::check())
                                                <a href="{{ route('carousel.edit', 1) }}" class="btn btn-primary btn-sm" title="Numai pentru profesori / For Teachers only">Edit 1</a>
                                                @endif
                                            </div>
                                            @endif 
                                            @if ($carousel->id == 2)
                                            <div id="slide-content-1">
                                             <h2>{{ $carousel->title }}</h2>
                                             <p>{{ $carousel->body }}</p>
                                             <p class="sub-text">{{ date('M j, Y', strtotime($carousel->updated_at)) }} - <a href="#">{{ $carousel->readmore }}</a></p>
                                             <hr><hr> 
                                             @if (Auth::check())
                                             <a href="{{ route('carousel.edit', 2) }}" class="btn btn-primary btn-sm" title="Numai pentru profesori / For Teachers only">Edit 2</a>
                                             @endif
                                         </div>
                                         @endif 
                                         @if ($carousel->id == 3)
                                         <div id="slide-content-2">
                                             <h2>{{ $carousel->title }}</h2>
                                             <p>{{ $carousel->body }}</p>
                                             <p class="sub-text">{{ date('M j, Y', strtotime($carousel->updated_at)) }} - <a href="#">{{ $carousel->readmore }}</a></p>
                                             <hr><hr>
                                             @if (Auth::check())
                                             <a href="{{ route('carousel.edit', 3) }}" class="btn btn-primary btn-sm" title="Numai pentru profesori / For Teachers only">Edit 3</a>
                                             @endif
                                         </div>
                                         @endif 
                                         @if ($carousel->id == 4)
                                         <div id="slide-content-3">
                                             <h2>{{ $carousel->title }}</h2>
                                             <p>{{ $carousel->body }}</p>
                                             <p class="sub-text">{{ date('M j, Y', strtotime($carousel->updated_at)) }} - <a href="#">{{ $carousel->readmore }}</a></p>
                                             <hr><hr> 
                                             @if (Auth::check())
                                             <a href="{{ route('carousel.edit', 4) }}" class="btn btn-primary btn-sm" title="Numai pentru profesori / For Teachers only">Edit 4</a>
                                             @endif
                                         </div>
                                         @endif 
                                         @if ($carousel->id == 5)
                                         <div id="slide-content-4">
                                             <h2>{{ $carousel->title }}</h2>
                                             <p>{{ $carousel->body }}</p>
                                             <p class="sub-text">{{ date('M j, Y', strtotime($carousel->updated_at)) }} - <a href="#">{{ $carousel->readmore }}</a></p>
                                             <hr><hr> 
                                             @if (Auth::check())
                                             <a href="{{ route('carousel.edit', 5) }}" class="btn btn-primary btn-sm" title="Numai pentru profesori / For Teachers only">Edit 5</a>
                                             @endif
                                         </div>
                                         @endif 
                                         @if ($carousel->id == 6)
                                         <div id="slide-content-5">
                                             <h2>{{ $carousel->title }}</h2>
                                             <p>{{ $carousel->body }}</p>
                                             <p class="sub-text">{{ date('M j, Y', strtotime($carousel->updated_at)) }} - <a href="#">{{ $carousel->readmore }}</a></p>
                                             <hr><hr> 
                                             @if (Auth::check())
                                             <a href="{{ route('carousel.edit', 6) }}" class="btn btn-primary btn-sm" title="Numai pentru profesori / For Teachers only">Edit 6</a>
                                             @endif
                                         </div>
                                         @endif 
                                         @endforeach 
                                     </div>
                                 </div>
                             </div>
                         </div><!--/Slider-->

                         <div class="row hidden-xs" id="slider-thumbs">
                            <!-- Bottom switcher of slider -->
                            <ul class="hide-bullets">
                               @foreach ($carousels as $carousel)
                               @if ($carousel->id == 1)
                               <li class="col-sm-2">
                                <a class="thumbnail" id="carousel-selector-0"><img src="img/foto01.jpg"></a>
                            </li>
                            @endif 
                            @if ($carousel->id == 2)
                            <li class="col-sm-2">
                                <a class="thumbnail" id="carousel-selector-1"><img src="img/foto02.jpg"></a>
                            </li>
                            @endif 
                            @if ($carousel->id == 3)
                            <li class="col-sm-2">
                                <a class="thumbnail" id="carousel-selector-2"><img src="img/foto03.jpg"></a>
                            </li>
                            @endif 
                            @if ($carousel->id == 4)
                            <li class="col-sm-2">
                                <a class="thumbnail" id="carousel-selector-3"><img src="img/foto04.jpg"></a>
                            </li>
                            @endif 
                            @if ($carousel->id == 5)
                            <li class="col-sm-2">
                                <a class="thumbnail" id="carousel-selector-4"><img src="img/foto05.jpg"></a>
                            </li>
                            @endif 
                            @if ($carousel->id == 6)
                            <li class="col-sm-2">
                                <a class="thumbnail" id="carousel-selector-5"><img src="img/foto06.jpg"></a>
                            </li>
                            @endif 
                            @endforeach 

                        </ul>                 
                    </div>
                </div>
            </div>
            @endsection
            @section('scripts')
            {!! Html::script('js/carousel.js') !!}
            <script type="text/javascript">

            </script>
            @endsection