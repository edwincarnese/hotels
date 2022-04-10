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
                @auth
                    <form action="{{ route('booking.hotel.show', $unit->id) }}" method="POST">
                        @csrf
                        <h3 class="inner">Choose Date</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="icon-calendar-7"></i> Check in</label>
                                    <input class="date-pick form-control" data-date-format="M d, D" type="text" name="checkin_date">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label><i class="icon-calendar-7"></i> Check out</label>
                                    <input class="date-pick form-control" data-date-format="M d, D" type="text" name="checkout_date">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Adults</label>
                                    <div class="numbers-row">
                                        <input type="text" value="1" id="adults" class="qty2 form-control" name="adult">
                                    </div>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label>Children</label>
                                    <div class="numbers-row">
                                        <input type="text" value="0" id="children" class="qty2 form-control" name="children">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <button type="submit" class="btn_full">Check now</button>
                    </form>
                @else
                    <a class="btn_full" href="/register">Register to book this hotel</a>
                @endauth()
            </div>

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
{{-- <script type="text/javascript" src="{{ asset('assets/js/map_hotels.js') }}"></script> --}}

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
    const locationData = {!! $units !!};
    
    let LocsA = [];
    let lat = 8.9559536672309;
    let lng = 125.52851005253486;
    
    for(let i = 0; i < locationData.length; i++) {
        const propertyAddress = locationData[i]['address'];
        const propertyImage = '/storage/'+locationData[i]['main_photo'];

        lat = locationData[i]['latitude'];
        lng = locationData[i]['longitude'];
    
        LocsA.push(
            {
                name: locationData[i]['name'],
                location_latitude: locationData[i]['latitude'],
                location_longitude: locationData[i]['longitude'],
                map_image_url: '/storage/'+locationData[i]['main_photo'],
                name_point: locationData[i]['name'],
                description_point: '',
                get_directions_start_address: '',
                url_point: '/hotels-unit/' + locationData[i]['id']
            },
        );
    }
    
    $('#collapseMap').on('shown.bs.collapse', function(e){
        (function(A) {
    
        if (!Array.prototype.forEach)
            A.forEach = A.forEach || function(action, that) {
                for (var i = 0, l = this.length; i < l; i++)
                    if (i in this)
                        action.call(that, this[i], i, this);
                };
    
            })(Array.prototype);
    
            var
            mapObject,
            markers = [],
            markersData = {
                'Hotels': LocsA
            };
    
                var mapOptions = {
                    zoom: 8,
                    center: new google.maps.LatLng(lat, lng),
                    mapTypeId: google.maps.MapTypeId.ROADMAP,
    
                    mapTypeControl: false,
                    mapTypeControlOptions: {
                        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
                        position: google.maps.ControlPosition.LEFT_CENTER
                    },
                };
                var
                marker;
                mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
                for (var key in markersData)
                    markersData[key].forEach(function (item) {
                        marker = new google.maps.Marker({
                            position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
                            map: mapObject,
                            icon: '/assets/img/pins/' + key + '.png',
                        });
    
                        if ('undefined' === typeof markers[key])
                            markers[key] = [];
                        markers[key].push(marker);
                        google.maps.event.addListener(marker, 'click', (function () {
            closeInfoBox();
            getInfoBox(item).open(mapObject, this);
            mapObject.setCenter(new google.maps.LatLng(item.location_latitude, item.location_longitude));
            }));
    
                        
                    });
        
    
            function hideAllMarkers () {
                for (var key in markers)
                    markers[key].forEach(function (marker) {
                        marker.setMap(null);
                    });
            };
    
            function closeInfoBox() {
                $('div.infoBox').remove();
            };
    
            function getInfoBox(item) {
                return new InfoBox({
                    content:
                    '<div class="marker_info" id="marker_info">' +
                    '<img src="' + item.map_image_url + '" alt="Image" style="width: 280px; height: 140px;"/>' +
                    '<h3>'+ item.name_point +'</h3>' +
                    '<span>'+ item.description_point +'</span>' +
                    '<div class="marker_tools">' +
                    '<form hidden action="http://maps.google.com/maps" method="get" target="_blank" style="display:inline-block""><input name="saddr" value="'+ item.get_directions_start_address +'" type="hidden"><input type="hidden" name="daddr" value="'+ item.location_latitude +',' +item.location_longitude +'"><button type="submit" value="Get directions" class="btn_infobox_get_directions">Directions</button></form>' +
                        '<a href="'+ item.url_point + '" class="btn_infobox">Details</a>' +
                    '</div>',
                    disableAutoPan: false,
                    maxWidth: 0,
                    pixelOffset: new google.maps.Size(10, 125),
                    closeBoxMargin: '5px -20px 2px 2px',
                    closeBoxURL: "http://www.google.com/intl/en_us/mapfiles/close.gif",
                    isHidden: false,
                    alignBottom: true,
                    pane: 'floatPane',
                    enableEventPropagation: true
                });
            };
        });
</script>

<!--Review modal validation -->
<script type="text/javascript" src="{{ asset('assets/js/infobox.js') }}"></script>
<script src="{{ asset('assets/assets/validate.js') }}"></script>
@endsection