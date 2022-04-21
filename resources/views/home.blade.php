@extends('layouts.app')

@section('content')
<section id="hero">
    <div class="intro_title">
        <h3 class="animated fadeInDown">Affordable Hotels</h3>
        <p class="animated fadeInDown">City Hotels / Hotel Guides</p>
        <a href="/hotels" class="animated fadeInUp button_intro">View Hotels</a> 
        <a href="/tours" class="animated fadeInUp button_intro outline">View Tours</a>
    </div>

    
</section>

<div class="container margin_60">
    <div class="main_title">
        <h2><span>Featured</span> Tours</h2>
        {{-- <p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p> --}}
    </div>
    <div class="row">
        @foreach($tours as $tour)
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                <div class="tour_container">
                    <div class="ribbon_3 popular"><span>Popular</span></div>
                    <div class="img_container">
                        <a href="{{ route('tours.show', $tour->id) }}">
                            <img src="{{ asset('storage/'.$tour->main_photo) }}" width="800" height="533" class="img-fluid" alt="Image">
                            <div class="short_info">
                                <i class="icon_set_1_icon-44"></i>{{ $tour->title }}
                            </div>
                        </a>
                    </div>
                    <div class="tour_title">
                        <h3><strong>{{ $tour->title }}</strong> Tour</h3>
                        <div class="rating">   
                            @if($tour->review)                                                
                                @for($rate = 1; $rate <= $tour->review; $rate++)
                                    <i class="icon-star voted"></i>                   
                                @endfor
                                @for($rate=$tour->review; $rate<5; $rate++)
                                    <i class="icon-star"> </i>
                                @endfor
                            @endif   
                         
                        </div> 
                    </div>
                    <div class="rating">                   
                        {{-- @if($tour->rate)
                            
                            @for($rate = 1; $rate <= $tour->rate; $rate++)
                            <i class="icon-star voted"></i>                       
                            @endfor
                            @for($rate=$tour->rate; $rate<5; $rate++)
                            <i class="icon-star"></i>
                            @endfor

                        @endif                       --}}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <p class="text-center nopadding" id="view-map">
        <a href="/tours" class="btn_1 medium"><i class="icon-eye-7"></i>View all tours </a>
    </p>
</div>

<div id="map" class="map"></div>


<Div class="container margin_60">
    <div class="main_title">
        <h2><span>Featured</span> Hotels</h2>
        {{-- <p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p> --}}
    </div>
    <div class="row">
        @foreach($units as $unit)
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                <div class="tour_container">
                    <div class="ribbon_3 popular"><span>Popular</span></div>
                    <div class="img_container">
                        <a href="{{ route('hotels.unit.show', $unit->id) }}">
                        <img src="{{ asset('storage/'.$unit->main_photo) }}" width="800" height="533" class="img-fluid" alt="Image">
                        <div class="short_info">
                            <i class="icon_set_1_icon-44"></i>{{ $unit->name }}<span class="price">{{ $unit->price }}</span>
                        </div>
                        </a>
                    </div>
                    <div class="tour_title">
                        <h3><strong>{{ $unit->name }}</strong> Hotel</h3>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <p class="text-center nopadding" id="view-map">
        <a href="/hotels" class="btn_1 medium"><i class="icon-eye-7"></i>View all hotels </a>
    </p>
</div>



@endsection

@section('js')
<script src="http://maps.googleapis.com/maps/api/js"></script>
{{-- <script type="text/javascript" src="{{ asset('assets/js/map_home.js') }}"></script> --}}


<script>
    const locationData = {!! $units !!};

    let LocsA = [];

    for(let i = 0; i < locationData.length; i++) {
        const propertyAddress = locationData[i]['address'];
        const propertyImage = 'storage/'+locationData[i]['main_photo'];

        LocsA.push(
            {
                name: locationData[i]['name'],
                location_latitude: locationData[i]['latitude'],
                location_longitude: locationData[i]['longitude'],
                map_image_url: 'storage/'+locationData[i]['main_photo'],
                name_point: locationData[i]['name'],
                description_point: '',
                get_directions_start_address: '',
                phone: '+3934245255',
                url_point: 'hotels-unit/' + locationData[i]['id']
            },
        );
    }

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
                center: new google.maps.LatLng(8.9559536672309, 125.52851005253486),
                mapTypeId: google.maps.MapTypeId.ROADMAP,

                mapTypeControl: false,
            };
            var
            marker;
            mapObject = new google.maps.Map(document.getElementById('map'), mapOptions);
            for (var key in markersData)
                markersData[key].forEach(function (item) {
                    marker = new google.maps.Marker({
                        position: new google.maps.LatLng(item.location_latitude, item.location_longitude),
                        map: mapObject,
                        icon: 'assets/img/pins/' + key + '.png',
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
                '<a href="tel://'+ item.phone +'" class="btn_infobox_phone">'+ item.phone +'</a>' +
                '</div>' +
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
</script>


<script type="text/javascript" src="{{ asset('assets/js/infobox.js') }}"></script>
@endsection