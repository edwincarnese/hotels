@extends('layouts.app')

@section('content')
<section class="parallax-window" data-parallax="scroll" data-image-src="{{ asset('assets/img/hotels_bg.jpg') }}" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-1">
    </div>
    <div class="parallax-content-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    {{-- <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class=" icon-star-empty"></i></span> --}}
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
</section>

<div id="position">
    <div class="container">
        <ul>
            <li><a href="#">Holel</a>
            </li>
        </ul>
    </div>
</div>
<!-- End Position -->

<div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
</div>
<!-- End Map -->

<div class="container margin_60">
    <div class="row">
        <div class="col-lg-8" id="single_tour_desc">
            <div id="single_tour_feat">
                <ul>
                    <li><i class="icon_set_2_icon-116"></i>Plasma TV</li>
                    <li><i class="icon_set_1_icon-86"></i>Free Wifi</li>
                    <li><i class="icon_set_2_icon-110"></i>Poll</li>
                    <li><i class="icon_set_1_icon-59"></i>Breakfast</li>
                    <li><i class="icon_set_1_icon-22"></i>Pet allowed</li>
                    <li><i class="icon_set_1_icon-13"></i>Accessibiliy</li>
                    <li><i class="icon_set_1_icon-27"></i>Parking</li>
                </ul>
            </div>
            <p class="d-none d-md-block d-block d-lg-none"><a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
            </p>
            <!-- Map button for tablets/mobiles -->
            <div id="Img_carousel" class="slider-pro">
                <div class="sp-slides">
                    @foreach(json_decode($unit->images) as $image)
                    <div class="sp-slide">
                        <img class="sp-image" src="{{ asset('storage/'.$image) }}" data-src="{{ asset('storage/'.$image) }}" data-small="{{ asset('storage/'.$image) }}" data-medium="{{ asset('storage/'.$image) }}" data-large="{{ asset('storage/'.$image) }}" data-retina="{{ asset('storage/'.$image) }}">
                    </div>
                    @endforeach
                </div>
                <div class="sp-thumbnails">
                    @foreach(json_decode($unit->images) as $image)
                        <img class="sp-thumbnail" src="{{ asset('storage/'.$image) }}">
                    @endforeach
                </div>
            </div>

            <hr>

            <div class="row">
                <div class="col-lg-3">
                    <h3>Description</h3>
                </div>
                <div class="col-lg-9">
                    <p>
                        {{ $unit->description }}
                    </p>
                    <h4>Hotel facilities</h4>
                    <div class="row">
                        <div class="col-md-6">
                            @if($unit->facilities)
                                <ul class="list_ok">
                                    @foreach(json_decode($unit->facilities) as $facility)
                                        <li>{{ $facility }}</li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
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
            <div class="box_style_1 expose">
                <h3 class="inner">Check Availability</h3>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="icon-calendar-7"></i> Check in</label>
                            <input class="date-pick form-control" data-date-format="M d, D" type="text">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label><i class="icon-calendar-7"></i> Check out</label>
                            <input class="date-pick form-control" data-date-format="M d, D" type="text">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Adults</label>
                            <div class="numbers-row">
                                <input type="text" value="1" id="adults" class="qty2 form-control" name="quantity">
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Children</label>
                            <div class="numbers-row">
                                <input type="text" value="0" id="children" class="qty2 form-control" name="quantity">
                            </div>
                        </div>
                    </div>
                </div>
                <br>

                <a class="btn_full" href="/book-hotel/{{ $unit->id }}">Check now</a>
                {{-- <a class="btn_full_outline" href="#"><i class=" icon-heart"></i> Add to whislist</a> --}}
            </div>
            <!--/box_style_1 -->

            <div class="box_style_4">
                <i class="icon_set_1_icon-90"></i>
                <h4><span>Book</span> by phone</h4>
                <a href="tel://004542344599" class="phone">+45 423 445 99</a>
                <small>Monday to Friday 9.00am - 7.30pm</small>
            </div>

        </aside>
    </div>
    <!--End row -->
</div>
<!--End container -->

<div id="overlay"></div>
<!-- Mask on input focus -->

@endsection

@section('js')
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript" src="{{ asset('assets/js/map_hotels.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/infobox.js') }}"></script>

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

<!--Review modal validation -->
<script src="{{ asset('assets/assets/validate.js') }}"></script>
@endsection