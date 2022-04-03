@extends('layouts.app')

@section('content')
<section id="hero">
    <div class="intro_title">
        <h3 class="animated fadeInDown">Affordable Hotels</h3>
        <p class="animated fadeInDown">City Hotels / Hotel Guides</p>
        <a href="/hotels" class="animated fadeInUp button_intro">View Hotels</a> 
        <a href="#view-map" class="animated fadeInUp button_intro outline">View Map</a>
    </div>
</section>

<div class="container margin_60">

    <div class="main_title">
        <h2><span>Featured</span> Hotels</h2>
        {{-- <p>Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.</p> --}}
    </div>

    <div class="row">
        <div class="col-lg-4 col-md-6 wow zoomIn" data-wow-delay="0.1s">
            <div class="tour_container">
                <div class="ribbon_3 popular"><span>Popular</span></div>
                <div class="img_container">
                    <a href="single_tour.html">
                    <img src="{{ asset('assets/img/tour_box_1.jpg') }}" width="800" height="533" class="img-fluid" alt="Image">
                    <div class="short_info">
                        <i class="icon_set_1_icon-44"></i>Historic Buildings<span class="price"><sup>$</sup>39</span>
                    </div>
                    </a>
                </div>
                <div class="tour_title">
                    <h3><strong>Arc Triomphe</strong> tour</h3>
                    <div class="rating">
                        <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
                    </div><!-- end rating -->
                    <div class="wishlist">
                        <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                    </div><!-- End wish list-->
                </div>
            </div><!-- End box tour -->
        </div><!-- End col -->
    </div>
    
    <p class="text-center nopadding" id="view-map">
        <a href="/hotels" class="btn_1 medium"><i class="icon-eye-7"></i>View all hotels </a>
    </p>
</div>
<!-- End container -->

<div id="map" class="map"></div>
<!-- End map -->

<div class="white_bg">
    <div class="container margin_60">
        <div class="main_title">
            <h2>Other <span>Popular</span> Hotels</h2>
            <p>
                Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.
            </p>
        </div>
        <div class="row add_bottom_45">
            <div class="col-lg-4 other_tours">
                <ul>
                    <li><a href="#"><i class="icon_set_1_icon-3"></i>Tour Eiffel<span class="other_tours_price">$42</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-30"></i>Shopping tour<span class="other_tours_price">$35</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-44"></i>Versailles tour<span class="other_tours_price">$20</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-3"></i>Montparnasse skyline<span class="other_tours_price">$26</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-44"></i>Pompidue<span class="other_tours_price">$26</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-3"></i>Senna River tour<span class="other_tours_price">$32</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 other_tours">
                <ul>
                    <li><a href="#"><i class="icon_set_1_icon-1"></i>Notredame<span class="other_tours_price">$48</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-4"></i>Lafaiette<span class="other_tours_price">$55</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-30"></i>Trocadero<span class="other_tours_price">$76</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-3"></i>Open Bus tour<span class="other_tours_price">$55</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-30"></i>Louvre museum<span class="other_tours_price">$24</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-3"></i>Madlene Cathedral<span class="other_tours_price">$24</span></a>
                    </li>
                </ul>
            </div>
            <div class="col-lg-4 other_tours">
                <ul>
                    <li><a href="#"><i class="icon_set_1_icon-37"></i>Montparnasse<span class="other_tours_price">$36</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-1"></i>D'Orsey museum<span class="other_tours_price">$28</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-50"></i>Gioconda Louvre musuem<span class="other_tours_price">$44</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-44"></i>Tour Eiffel<span class="other_tours_price">$56</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-50"></i>Ladefanse<span class="other_tours_price">$16</span></a>
                    </li>
                    <li><a href="#"><i class="icon_set_1_icon-44"></i>Notredame<span class="other_tours_price">$26</span></a>
                    </li>
                </ul>
            </div>
        </div>
        <!-- End row -->
    </div>
    <!-- End container -->
</div>
<!-- End white_bg -->

<section class="promo_full">
    <div class="promo_full_wp magnific">
        <div>
            <h3>BELONG ANYWHERE</h3>
            <p>
                Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset, doctus volumus explicari qui ex.
            </p>
            <a href="https://www.youtube.com/watch?v=Zz5cu72Gv5Y" class="video"><i class="icon-play-circled2-1"></i></a>
        </div>
    </div>
</section>
<!-- End section -->

<div class="container margin_60">

    <div class="main_title">
        <h2>Some <span>good</span> reasons</h2>
        <p>
            Quisque at tortor a libero posuere laoreet vitae sed arcu. Curabitur consequat.
        </p>
    </div>

    <div class="row">

        <div class="col-lg-4 wow zoomIn" data-wow-delay="0.2s">
            <div class="feature_home">
                <i class="icon_set_1_icon-41"></i>
                <h3><span>+120</span> Premium tours</h3>
                <p>
                    Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
                </p>
                <a href="about.html" class="btn_1 outline">Read more</a>
            </div>
        </div>

        <div class="col-lg-4 wow zoomIn" data-wow-delay="0.4s">
            <div class="feature_home">
                <i class="icon_set_1_icon-30"></i>
                <h3><span>+1000</span> Customers</h3>
                <p>
                    Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
                </p>
                <a href="about.html" class="btn_1 outline">Read more</a>
            </div>
        </div>

        <div class="col-lg-4 wow zoomIn" data-wow-delay="0.6s">
            <div class="feature_home">
                <i class="icon_set_1_icon-57"></i>
                <h3><span>H24 </span> Support</h3>
                <p>
                    Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
                </p>
                <a href="about.html" class="btn_1 outline">Read more</a>
            </div>
        </div>

    </div>
    <!--End row -->

    <hr>

    <div class="row">
        <div class="col-md-6">
            <img src="{{ asset('assets/img/laptop.png') }}" alt="Laptop" class="img-fluid laptop">
        </div>
        <div class="col-md-6">
            <h3><span>Get started</span> with {{ config('app.name') }}</h3>
            <p>
                Lorem ipsum dolor sit amet, vix erat audiam ei. Cum doctus civibus efficiantur in. Nec id tempor imperdiet deterruisset.
            </p>
            <ul class="list_order">
                <li><span>1</span>Select your preferred tours</li>
                <li><span>2</span>Purchase tickets and options</li>
                <li><span>3</span>Pick them directly from your office</li>
            </ul>
            <a href="all_tour_list.html" class="btn_1">Start now</a>
        </div>
    </div>
</div>
@endsection

@section('js')
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript" src="{{ asset('assets/js/map_home.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/infobox.js') }}"></script>
@endsection