@extends('layouts.app')

@section('content')
<section class="parallax-window" 
style="background-image: url({{ asset('storage/'.$tour->main_photo) }}); background-repeat: no-repeat; background-position: center;"
data-parallax="scroll" data-image-src="{{ asset('assets/img/hotels_bg.jpg') }}" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-1">
    </div>
    <div class="parallax-content-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    {{-- <span class="rating"><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class="icon-star voted"></i><i class=" icon-star-empty"></i></span> --}}
                    <h1>{{ $tour->title }}</h1>
                    <span>{{ $tour->address }} {{ $tour->city }}, {{ $tour->zip_code }} {{ $tour->country }}</span>
                </div>
                <div class="col-md-4">
                    <div id="price_single_main" class="hotel">
                        {{-- {{ $tour->period }}  --}}
                        {{-- <span><sup>₱</sup>{{ $tour->price }}</span> --}}
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
            <p class="d-none d-md-block d-block d-lg-none"><a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
            </p>
            <!-- Map button for tablets/mobiles -->
            <div id="Img_carousel" class="slider-pro">
                <div class="sp-slides">
                    @if($tour->images)
                        @foreach(json_decode($tour->images) as $image)
                        <div class="sp-slide">
                            <img class="sp-image" src="{{ asset('storage/'.$image) }}" data-src="{{ asset('storage/'.$image) }}" data-small="{{ asset('storage/'.$image) }}" data-medium="{{ asset('storage/'.$image) }}" data-large="{{ asset('storage/'.$image) }}" data-retina="{{ asset('storage/'.$image) }}">
                        </div>
                        @endforeach
                    @endif
                </div>

               
                <div class="sp-thumbnails">
                    @if($tour->images)
                        @foreach(json_decode($tour->images) as $image)
                            <img class="sp-thumbnail" src="{{ asset('storage/'.$image) }}">
                        @endforeach
                    @endif
                </div>
            </div>

            {{-- @foreach($reviews as $review)          
            @endforeach --}}
            {{-- <div class="row">
                <h2>Ratings: &nbsp; </h2>
                @if($getAverageRate <= 3 )
                    <h2 style = "color:red;">{{floor($getAverageRate)}}</h2>
                @else
                    <h2 style = "color: rgb(212, 226, 7);"> {{floor($getAverageRate)}}</h2>
                @endif  
            </div> --}}

            <hr>

            <div class="row">
                <div class="col-lg-3">
                    <h3>Description</h3>
                </div>
                <div class="col-lg-9">
                    <p>
                        {{ $tour->description }}
                    </p>
                    @if($tour->amenities && $tour->amenities_prices)
                        <h4>Amenities</h4>
                        <div class="row">
                            @php 
                                $amenities = json_decode($tour->amenities); 
                                $amenities_prices = json_decode($tour->amenities_prices); 
                            @endphp
                            @for($i = 0; $i < count($amenities); $i++)
                                <div class="col-md-6">
                                    <h4>Name: {{ $amenities[$i] }}</h4>
                                </div>
                                <div class="col-md-6">
                                    <h4>Price: {{ $amenities_prices[$i] }}</h4>
                                </div>
                            @endfor
                        </div>
                    @endif
                </div>
                <!-- End col-md-9  -->
            </div>
        </div>
        <!--End  single_tour_desc-->


        <aside class="col-lg-4">
            <p class="d-none d-xl-block d-lg-block d-xl-none">
                <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
            </p>
            
            {{-- <div class="box_style_1 expose">
                @auth
                    <form action="{{route('booking.tour.show',$tour->id)}}" method="POST">
                        @csrf
                        <h3 class="inner">Choose Date</h3>
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
                                    <input class="date-pick form-control" date-local  type="text" name="checkout_date">
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn_full">Check now</button>
                    </form>
                @else
                    <a class="btn_full" href="/register">Register to book this hotel</a>
                @endauth()
            </div> --}}
            <div class="box_style_4">
                <i class="icon_set_1_icon-90"></i>
                <h4><span>Call</span> by phone</h4>
                <a href="tel://+63 936 127 2791" class="phone">+63 936 127 2791</a>
                <small>Monday to Friday 9.00am - 7.30pm</small>
            </div>

        </aside>
    </div>

    
    {{-- <h1>List of Rooms</h1>
    <div class="row">
        @foreach($rooms as $room)
            <div class="col-lg-4">
                @if($room->main_photo)
                    <img src="{{ asset('storage/'.$room->main_photo) }}" class="img-fluid styled profile_pic mt-0">
                @else
                    <img src="{{ asset('assets/img/tourist_guide_pic.jpg') }}" class="img-fluid styled profile_pic mt-0">
                @endif
                <h4>{{$room->name }} </h4>
                <p>
                    <span>₱ {{ $room->price }} / {{ $room->period }}</span>s
                </p>
                <div class="row">
                    <div class="col-md-12">
                        <ul class="list_icons">
                            <li>{{$room->capacity}}</i> Capcity</li>
                            <li>{{$room->bedroom}}</i> Bedroom</li>
                            <li>{{$room->bathroom}}</i> Bathroom</li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    </div> --}}

    <div class="row">
        <div class="col-lg-3">
            <h3>Reviews</h3>
            @guest()
                <a href="#sign-in-dialog" class="access_link btn_1 add_bottom_30">Login to add review</a>
            @endguest
            @auth
                @if(Auth::user()->id != $tour->user_id)
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
                            {{-- {{$getStar = $review->rate}} --}}
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
<input type="hidden" id="pages-home" value="{{ route('tours.show', $tour->id) }}">

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
const urlTourEndpoint = '/tours/';
// const locationDataHotels = {!! $units !!};
const locationDataHotels = [];
const locationDataTours = {!! $tours !!};
autoRoute = true;
</script>

<!--Review modal validation -->
<script type="text/javascript" src="{{ asset('assets/js/infobox.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/app/shared.js') }}"></script>
<script src="{{ asset('assets/assets/validate.js') }}"></script>
@endsection