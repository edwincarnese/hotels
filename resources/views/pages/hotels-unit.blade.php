@extends('layouts.app')

@section('css')
<!-- REVOLUTION SLIDER CSS -->
<link href="{{ asset('assets/rs-plugin/css/settings.css') }}" rel="stylesheet">
<link href="{{ asset('assets/css/extralayers.css') }}" rel="stylesheet">    
@endsection

@section('content')
{{-- <section class="parallax-window" 
<img src="{{ asset('storage/'.$unit->main_photo) }}" class="img-fluid styled profile_pic mt-0">
style="background-image: url({{ asset('storage/'.$unit->main_photo) }}); background-repeat: no-repeat; background-position: center;"
data-parallax="scroll" data-image-src="{{ asset('assets/img/hotels_bg.jpg') }}" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-1">
    </div>
    <div class="parallax-content-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class=" icon-star-empty"></i></span>
                    <h1>{{ $unit->name }}</h1>
                    <span>{{ $unit->address }} {{ $unit->city }}, {{ $unit->zip_code }} {{ $unit->country }}</span>
                </div>
                <div class="col-md-4">
                    <div id="price_single_main" class="hotel">
                        {{ $unit->period }} <span><sup>₱</sup>{{ $unit->price }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}

<div class="tp-banner-container">
    <div class="tp-banner">
        <ul>
            @if($unit->images)
                @foreach(json_decode($unit->images) as $image)
                <li data-transition="fade" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="Intro Slide">
                    <img src="{{ asset('storage/'.$image) }}" alt="slidebg1" data-lazyload="{{ asset('storage/'.$image) }}" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                </li>
                @endforeach
            @endif
        </ul>
        <div class="tp-bannertimer tp-bottom"></div>
    </div>
</div>

<div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
    <button type="button" onclick="findMe()" class="btn_1 medium btn-block">Near Me</button>
</div>

<div class="container margin_60">
    <div class="row">
        <div class="col-lg-8" id="single_tour_desc">
            {{-- <div id="single_tour_feat">
                <ul>
                    <li><i class="icon_set_2_icon-116"></i>Plasma TV</li>
                    <li><i class="icon_set_1_icon-86"></i>Free Wifi</li>
                    <li><i class="icon_set_2_icon-110"></i>Poll</li>
                    <li><i class="icon_set_1_icon-59"></i>Breakfast</li>
                    <li><i class="icon_set_1_icon-22"></i>Pet allowed</li>
                    <li><i class="icon_set_1_icon-13"></i>Accessibiliy</li>
                    <li><i class="icon_set_1_icon-27"></i>Parking</li>
                </ul>
            </div> --}}
            <p class="d-none d-md-block d-block d-lg-none">
                <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
            </p>
            <!-- Map button for tablets/mobiles -->
            <div id="Img_carousel" class="slider-pro">
                <div class="sp-slides">
                    @if($unit->images)
                        @foreach(json_decode($unit->images) as $image)
                        <div class="sp-slide">
                            <img class="sp-image" src="{{ asset('storage/'.$image) }}" data-src="{{ asset('storage/'.$image) }}" data-small="{{ asset('storage/'.$image) }}" data-medium="{{ asset('storage/'.$image) }}" data-large="{{ asset('storage/'.$image) }}" data-retina="{{ asset('storage/'.$image) }}">
                        </div>
                        @endforeach
                    @endif
                </div>
                <div class="sp-thumbnails">
                    @if($unit->images)
                        @foreach(json_decode($unit->images) as $image)
                            <img class="sp-thumbnail" src="{{ asset('storage/'.$image) }}">
                        @endforeach
                    @endif
                </div>
            </div>

            <hr>

            <div class="row">
                <h3 class="col-lg-12 font-weight-bold">{{ $unit->name }}</h3>
                <h3 class="col-lg-12">Location: {{ $unit->address }}</h3>
                <div class="col-lg-3">
                    <h3>Description</h3>
                </div>
                <div class="col-lg-9">
                    <p>
                        {{ $unit->description }}
                    </p>
                    @if($unit->facilities)
                        <h4>Hotel facilities</h4>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list_ok">
                                    @foreach(json_decode($unit->facilities) as $facility)
                                        <li>{{ $facility }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                    <!-- End row  -->
                </div>
                <!-- End col-md-9  -->
            </div>
        </div>
        <!--End  single_tour_desc-->

        <aside class="col-lg-4">
            <p class="d-none d-xl-block d-lg-block d-xl-none">
                <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
            </p>
            <div class="box_style_4">
                <i class="icon_set_1_icon-90"></i>
                <h4><span>Call</span> by phone</h4>
                <a href="tel://+63 936 127 2791" class="phone">+63 936 127 2791</a>
                <small>Monday to Friday 9.00am - 7.30pm</small>
            </div>
        </aside>
    </div>
    <!--End row -->

    @if(count($rooms) > 0)
    <h3>List of Rooms</h3>
    <div class="row">
        @foreach($rooms as $room)
            <div class="col-lg-4">
                <div class="box_style_1 expose" style="text-align: center">
                    @if($room->main_photo)
                        <img style="max-height: 150px;" src="{{ asset('storage/'.$room->main_photo) }}" class="img-fluid styled profile_pic mt-0">
                    @else
                        <img src="{{ asset('assets/img/tourist_guide_pic.jpg') }}" class="img-fluid styled profile_pic mt-0">
                    @endif
                    <form action="{{ route('booking.hotel.show', $room->id) }}" method="POST">
                        @csrf
                        {{-- <h3 class="inner">Choose Date</h3> --}}
                        <div class="row mt-2">
                            <div class="col-md-12 text-center">
                                <h3 class="mt-0 font-weight-bold">{{ $room->name }}</h3>
                            </div>
                            <div class="col-md-12 text-center mb-2">
                                <h3 class="mt-0">₱ {{ number_format($room->price, 0) }} / {{ $room->period }}</h3>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ $room->capacity }} Guest</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ $room->bedroom }} Bedroom</label>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{ $room->bathroom }} Bathroom</label>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-4">
                            @if($room->facilities)
                                @foreach(json_decode($room->facilities) as $facility)
                                    <div class="col-md-4">
                                        <span class="text-success font-weight-bold">{{ $facility }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="icon-calendar-7"></i> Check in</label>
                                    <input class="date-pick form-control" date-local type="text" name="checkin_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="icon-calendar-7"></i> Check out</label>
                                    <input class="date-pick form-control" date-local type="text" name="checkout_date">
                                </div>
                            </div>
                        </div>
                        @auth
                            <button type="submit" class="btn_full">Check now</button>
                        @else
                            <a class="btn_full" href="/register">Register to book this hotel</a>
                        @endauth()
                    </form>   
                </div>
            </div>
            <hr>
        @endforeach
    </div>
    @endif

    <hr>

    <div class="row">
        <div class="col-lg-3">
            <h3>Reviews</h3>
            @guest()
                <a href="#sign-in-dialog" class="access_link btn_1 add_bottom_30">Login to add review</a>
            @endguest
            @auth
                @if(Auth::user()->id != $unit->user_id)
                    <a href="#" class="btn_1 add_bottom_30" data-toggle="modal" data-target="#myReview">Leave a review</a>
                @endif
            @endauth
        </div>
        @foreach($reviews as $review)
            <div class="col-lg-12">
                <div class="review_strip_single">
                    <small>{{ $review->created_at }}</small>
                    <h4>{{ $review->user->firstname ?? '' }} {{ $review->user->lastname ?? '' }}</h4>
                    
                    <div class="rating">                      
                        @if($review->rate)
                            @for($rate = 1; $rate <= $review->rate; $rate++)
                                <i class="icon-star voted"></i>                       
                            @endfor
                            @for($rate=$review->rate; $rate<5; $rate++)
                                <i class="icon-star"></i>
                            @endfor
                        @endif
                    </div>
                    <p>
                        {{ $review->message }}
                    </p>
                </div>
            </div>
        @endforeach
    </div>
</div>
<!--End container -->

<div id="overlay"></div>
<!-- Mask on input focus -->

<input type="hidden" id="pages-home" value="{{ route('hotels.unit.show', $unit->id) }}">
@endsection

@section('js')

<!-- Date and time pickers -->
<script src="{{ asset('assets/js/jquery.sliderPro.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function ($) {
        $('#Img_carousel').sliderPro({
            width: 960,
            height: 500,
            fade: true,
            arrows: true,
            buttons: false,
            fullScreen: false,
            smallSize: 500,
            startSlide: 0,
            mediumSize: 1000,
            largeSize: 3000,
            thumbnailArrows: true,
            autoplay: false
        });
    });
</script>

<!-- Date and time pickers -->
<script>
    $('input.date-pick').datepicker('setDate', 'today');
</script>

<!-- Carousel -->
<script>
    $('.carousel-thumbs-2').owlCarousel({
    loop:false,
    margin:5,
    responsiveClass:true,
    nav:false,
    responsive:{
        0:{
            items:1
        },
        600:{
            items:3
        },
        1000:{
            items:4,
            nav:false
        }
    }
});
</script>

<script>
    const urlEndpoint = '/hotels-unit/';
    const locationDataHotels = {!! $units !!};
    const locationDataTours = null;

    $('.btn_map').click(function() {
        pointLocation();
    });
</script>

<script type="text/javascript" src="{{ asset('assets/js/infobox.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/app/shared.js') }}"></script>
<script src="{{ asset('assets/validate.js') }}"></script>

<!-- SLIDER REVOLUTION 4.x SCRIPTS  -->
<script src="{{ asset('assets/rs-plugin/js/jquery.themepunch.tools.min.js') }}"></script>
<script src="{{ asset('assets/rs-plugin/js/jquery.themepunch.revolution.min.js') }}"></script>
<script src="{{ asset('assets/js/revolution_func.js') }}"></script>
@endsection