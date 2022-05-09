@extends('layouts.app')

@section('content')
<section id="hero">
    <div class="intro_title">
        <h3 class="animated fadeInDown">CARAGA TOURS</h3>
        <p class="animated fadeInDown">City Hotels / Hotel Guides</p>
        <a href="{{ route('hotels.index') }}" class="animated fadeInUp button_intro">View Hotels</a> 
        <a href="{{ route('tours.index') }}" class="animated fadeInUp button_intro outline">View Tours</a>
        <a href="{{ route('home', ['popular' => true]) }}" class="animated fadeInUp button_intro">Popular</a>
    </div>
</section>

@error('email')
    <h1 class="text-center font-weight-bold" style="color: red;">{{ $message }}</h1>
@enderror

@error('password')
    <h1 class="text-center font-weight-bold" style="color: red;">{{ $message }}</h1>
@enderror

<div class="mb-2 mt-2">
    <form action="{{ route('home') }}" method="GET">
        <input type="text" class="form-control mb-2" placeholder="Search by address" name="search" value="{{ Request::get('search') }}">
        <button type="submit" class="btn_1 medium btn-block">Search</button>
    </form>
</div>

<div class="mb-2 mt-2">
    <button type="button" onclick="findMe()" class="btn_1 medium btn-block">Near Me</button>
</div>
<div id="map" class="map" style="height: 700px;"></div>

<div class="container margin_60">
    <div class="main_title">
        <h2><span>Popular</span> Tours</h2>
        {{-- <p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p> --}}
    </div>
    <div class="row">
        @foreach($featured_tours as $tour)
            <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
                <div class="tour_container">
                    b
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

<Div class="container margin_60">
    <div class="main_title">
        <h2><span>Popular</span> Hotels</h2>
        {{-- <p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p> --}}
    </div>
    <div class="row">
        @foreach($featured_units as $unit)
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
                        <div class="rating">   
                            @if($unit->review)                                                
                                @for($rate = 1; $rate <= $tour->review; $rate++)
                                    <i class="icon-star voted"></i>                   
                                @endfor
                                @for($rate=$tour->review; $rate<5; $rate++)
                                    <i class="icon-star"> </i>
                                @endfor
                            @endif   
                         
                        </div> 
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <p class="text-center nopadding" id="view-map">
        <a href="/hotels" class="btn_1 medium"><i class="icon-eye-7"></i>View all hotels </a>
    </p>
</div>
<input type="hidden" id="pages-home" value="{{ route('home') }}">
@endsection

@section('js')

<script>
    const urlEndpoint = '/hotels-unit/';
    const urlTourEndpoint = '/tours/';

    const locationDataHotels = {!! $units !!};

    const locationDataTours = {!! $tours !!};
</script>

<script type="text/javascript" src="{{ asset('assets/js/infobox.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/app/shared.js') }}"></script>
@endsection