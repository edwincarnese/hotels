@extends('layouts.app')

@section('css')
<!-- SPECIFIC CSS -->
<link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')

<section class="parallax-window"   style="background-image: url({{ asset('assets/img/tour_bg.jpg') }});"
data-parallax="scroll" data-image-src="img/admin_top.jpg" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
            <h1>Hello {{ Auth::user()->firstname }}!</h1>
            <p>Start managing your account.</p>
        </div>
    </div>
</section>

<div id="position">
    <div class="container">
        <ul>
            <li><a href="#">Dashboard</a>
            </li>
        </ul>
    </div>
</div>
<!-- End Position -->

@if(Session::has('success'))
<div>
    <h3 class="text-center text-success font-weight-bold">{{ Session::get('success') }}</h3>
</div>
@endif

<div class="margin_60 container">
    <div id="tabs" class="tabs">
        <nav>
            <ul>              
                <li>
                    <a href="#section-1" class="icon-booking"><span>Bookings</span></a>
                </li>                
                <li><a href="#section-2" class="icon-th-list"><span>Tours</span></a>
                </li>
                <li><a href="#section-6" class="icon-th-list"><span>Rooms</span></a>
                </li>
                <li><a href="#section-3" class="icon-th-list"><span>Hotel Units</span></a>
                </li>
                <li><a href="#section-4" class="icon-settings"><span>Settings</span></a>
                </li>
                <li><a href="#section-5" class="icon-profile"><span>Profile</span></a>
                </li>
              
                {{-- <li><a href="#section-6" class="icon-wishlist"><span>Wishlist</span></a>
                </li> --}}
            </ul>
        </nav>
        <div class="content">
            <section id="section-1">
                @include('pages.dashboard._bookings')
            </section>

            <section id="section-2">
                @include('pages.dashboard._tours')
            </section>
            <!-- End section 2 -->

            <section id="section-6">
                @include('pages.dashboard._rooms')
            </section>
            <!-- End section 2 -->

            <section id="section-3">
                @include('pages.dashboard._units')
            </section>
            <!-- End section 3 -->

            <section id="section-4">
                @include('pages.dashboard._setting')
            </section>
            <!-- End section 4 -->

            <section id="section-5">
                @include('pages.dashboard._profile')
            </section>
            <!-- End section 5 -->
        </div>
        <!-- End content -->
    </div>
</div>
<!-- end container -->
@endsection

@section('js')
<!-- Specific scripts -->
<script src="{{ asset('assets/js/tabs.js') }}"></script>
<script>
    new CBPFWTabs(document.getElementById('tabs'));
</script>
<script>
    $('.wishlist_close_admin').on('click', function (c) {
        $(this).parent().parent().parent().fadeOut('slow', function (c) {});
    });
</script>
@endsection