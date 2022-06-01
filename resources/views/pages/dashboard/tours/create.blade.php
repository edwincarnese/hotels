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
    
    <div class="margin_60 container">
        <div class="row">
            <div class="col-6">
                <h4>Create Tour</h4>
            </div>
            <div class="col-6">
                <a href="{{ route('dashboard.index') }}" class="btn_1 float-right text-white">Cancel</a>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('dashboard.tours.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Tour info</h4>
                        </div>
                        <div class="@if(Auth::user()->role == 1) col-md-6 @else col-md-12 @endif">
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" name="title" type="text" required>
                            </div>
                        </div>
                        {{-- <div class="@if(Auth::user()->role == 1) col-md-4 @else col-md-6 @endif">
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" name="price" type="text">
                            </div>
                        </div> --}}
                        @if(Auth::user()->role == 1)
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Popular</label>
                                    <select class="form-control" name="is_popular">
                                        <option value="0">No</option>
                                        <option value="1">Yes</option>
                                    </select> 
                                </div>
                            </div>
                        @endif
                    </div>
            
                    <hr>
                    <h4>Tour Photos</h4>
                    <div class="form-inline upload_1">
                        <div class="form-group">
                            <input type="file" name="images[]" accept="image/*" multiple>
                        </div>
                    </div>
            
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Tour description</h4>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" name="description" rows="5"></textarea>
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Amenities</h4>
                        </div>
                    </div>

                    <div class="other-features row">
                    </div>
                    <button type="button" onclick="addAmenities()">Add Amenities</button>
            
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Address</h4>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Street address</label>
                                <input class="form-control" id="address" name="address" value="{{ Auth::user()->address }}" type="text">
                                <button type="button" onclick="searchByAddress()" class="btn btn-block btn-primary mt-2">Search</button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Map</h4>
                            <div id="map" class="map"></div>
                        </div>
                        <div class="col-md-6 mt-2" style="display: none">
                            <div class="form-group">
                                <label>Latitude</label>
                                <input class="form-control" name="latitude" id="map_lan" type="hidden">
                            </div>
                        </div>
                        <div class="col-md-6 mt-2" style="display: none">
                            <div class="form-group">
                                <label>Longitude</label>
                                <input class="form-control" name="longitude" id="map_long" type="hidden">
                            </div>
                        </div>
                    </div>
                    <!-- End row -->

                    <hr>
                    <button type="submit" class="btn-block btn_1 green">Create Tour</button>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('js')
<script src="{{ asset('assets/js/tabs.js') }}"></script>
<script>
    new CBPFWTabs(document.getElementById('tabs'));
</script>
<script>
    $('.wishlist_close_admin').on('click', function (c) {
        $(this).parent().parent().parent().fadeOut('slow', function (c) {});
    });
</script>
<script>
    function addAmenities()
    {
        $(".other-features").append(`<div class="col-md-6">
            <div class="form-group">
                <label>Name</label>
                <input class="form-control" name="amenities[]" type="text" required>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group">
                <label>Price</label>
                <input class="form-control" name="amenities_prices[]" type="text" required>
            </div>
        </div>`);
    }
</script>
<script type="text/javascript" src="{{ asset('assets/app/searchLocation.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/infobox.js') }}"></script>
@endsection