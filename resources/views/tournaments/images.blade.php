@extends('main')

@section('title', 'Images')
@section('stylesheets')
{!! Html::style('css/images.css') !!}

@endsection
@section('content')


<div class="container">
    <div id="main_area">
        <!-- Slider -->
        <div class="row">
            <div class="col-sm-6" id="slider-thumbs" style="overflow:auto; height:500px;">
                <!-- Bottom switcher of slider -->
                <ul class="hide-bullets">
                    @foreach ($files as $file)
                    <li class="col-sm-3">
                        <a class="thumbnail" id="carousel-selector-{{ $i++}}">
                            {!! Html::image('turnee/poze'.'/'.$id.'/'.$file) !!}{{$i}} 
                        </a>
                    </li>
					@endforeach
    
                </ul>
            </div>
            <div class="col-sm-6">
                <div class="col-xs-12" id="slider" >
                    <!-- Top part of the slider -->
                    <div class="row">
                        <div class="col-sm-12" id="carousel-bounding-box">
                            <div class="carousel slide" id="myCarousel">
                                <!-- Carousel items -->
                                <div class="carousel-inner">
                                    <div class="active item" data-slide-number="0">
                                        </div>
				                    @foreach ($files as $file)
                                    <div class="item" data-slide-number="{{$j++}}">
                                         {!! Html::image('turnee/poze'.'/'.$id.'/'.$file) !!}{{$j}} </div>
                                
									@endforeach
                   
                                </div>
                                <!-- Carousel nav -->
                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
                                    <span class="glyphicon glyphicon-chevron-left"></span>
                                </a>
                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/Slider-->
        </div>

    </div>
</div>

	@endsection

	@section('scripts')
	<script type="text/javascript">
		jQuery(document).ready(function($) {

			$('#myCarousel').carousel({
				interval: 5000
			});

        //Handles the carousel thumbnails
        $('[id^=carousel-selector-]').click(function () {
        	var id_selector = $(this).attr("id");
        	try {
        		var id = /-(\d+)$/.exec(id_selector)[1];
        		console.log(id_selector, id);
        		jQuery('#myCarousel').carousel(parseInt(id));
        	} catch (e) {
        		console.log('Regex failed!', e);
        	}
        });
        // When the carousel slides, auto update the text
        $('#myCarousel').on('slid.bs.carousel', function (e) {
        	var id = $('.item.active').data('slide-number');
        	$('#carousel-text').html($('#slide-content-'+id).html());
        });
    });
</script>
@endsection