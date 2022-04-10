@extends('layouts.app')

@section('css')
<!-- SPECIFIC CSS -->
<link href="{{ asset('assets/css/admin.css') }}" rel="stylesheet">
@endsection

@section('content')
    <section class="parallax-window" data-parallax="scroll" data-image-src="img/admin_top.jpg" data-natural-width="1400" data-natural-height="470">
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
                <h4>Edit Tour</h4>
            </div>
            <div class="col-6">
                <a href="{{ route('dashboard.index') }}" class="btn_1 float-right text-white">Cancel</a>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('dashboard.tours.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $tour->id }}">
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Tour info</h4>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Title</label>
                                <input class="form-control" name="title" type="text" value="{{ $tour->title }}" required>
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
            
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
                                <textarea class="form-control" name="description" rows="5">{{ $tour->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
            
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Amenities</h4>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <ul class="other-features">
                                    <li>
                                        <input type="checkbox" id="tour_guide" name="amenities[]" value="Tour guide">
                                        <label for="tour_guide">Tour guide</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="audio_guide" name="amenities[]" value="Audio guide">
                                        <label for="audio_guide">Audio guide</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="pet_allowed" name="amenities[]" value="Pet allowed">
                                        <label for="pet_allowed">Pet allowed</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="accessbility" name="amenities[]" value="Accessbility">
                                        <label for="accessbility">Accessbility</label>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
            
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Address</h4>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Street address</label>
                                <input class="form-control" name="address" value="{{ $tour->address }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>City/Town</label>
                                <input class="form-control" name="city" value="{{ $tour->city }}" type="text">
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
            
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Zip code</label> 
                                <input class="form-control" name="zip_code" value="{{ $tour->zip_code }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Country</label>
                                <input class="form-control" name="country" value="{{ $tour->country }}" type="text">
                            </div>
                        </div>
                    </div>
                    <!-- End row -->

                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Map</h4>
                            <div id="map" class="map"></div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Latitude</label>
                                <input class="form-control" name="latitude" id="map_lan" value="{{ $tour->latitude }}" type="text">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Longitude</label>
                                <input class="form-control" name="longitude" id="map_long" value="{{ $tour->longitude }}" type="text">
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
<script src="http://maps.googleapis.com/maps/api/js"></script>
<script type="text/javascript" src="{{ asset('assets/js/map_home.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/infobox.js') }}"></script>

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