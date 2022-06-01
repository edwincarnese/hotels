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
                <h4>Edit Hotel Unit</h4>
            </div>
            <div class="col-6">
                <a href="{{ route('dashboard.index') }}" class="btn_1 float-right text-white">Cancel</a>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('dashboard.units.update') }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $unit->id }}">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" value="{{ $unit->name }}" type="text" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" name="price" value="{{ $unit->price }}" type="text">
                            </div>
                        </div>
                        <div class="@if(Auth::user()->role == 1) col-md-2 @else col-md-3 @endif">
                            <div class="form-group">
                                <label>Availability</label>
                                <select class="form-control" name="is_available">
                                    <option value="1" @if($unit->is_available == 1) selected @endif>Available</option>
                                    <option value="0" @if($unit->is_available == 0) selected @endif>Not Available</option>
                                </select>
                            </div>
                        </div>
                        @if(Auth::user()->role == 1)
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>Popular</label>
                                    <select class="form-control" name="is_popular">
                                        <option value="0" @if(!$unit->is_popular) selected @endif>No</option>
                                        <option value="1" @if($unit->is_popular) selected @endif>Yes</option>
                                    </select> 
                                </div>
                            </div>
                        @endif
                        <div class="@if(Auth::user()->role == 1) col-md-2 @else col-md-3 @endif">
                            <div class="form-group">
                                <label>Mode of Payment</label>
                                <select class="form-control" name="is_available">
                                    <option value="1" @if($unit->enable_online_payment == 1) selected @endif>Pay Online</option>
                                    <option value="0" @if($unit->enable_online_payment == 0) selected @endif>Pay Hotel</option>
                                </select>
                            </div>
                        </div>

                        {{-- <div class="col-md-2">
                            <div class="form-group">
                                <label>Capacity</label>
                                <select class="form-control" name="capacity">
                                    <option value="1" @if($unit->bathroom == 1) selected @endif>1</option>
                                    <option value="2" @if($unit->bathroom == 2) selected @endif>2</option>
                                    <option value="3" @if($unit->bathroom == 3) selected @endif>3</option>
                                    <option value="4" @if($unit->bathroom == 4) selected @endif>4</option>
                                    <option value="5" @if($unit->bathroom == 5) selected @endif>5</option>
                                    <option value="6" @if($unit->bathroom == 6) selected @endif>6</option>
                                    <option value="7" @if($unit->bathroom == 7) selected @endif>7</option>
                                    <option value="8" @if($unit->bathroom == 8) selected @endif>8</option>
                                    <option value="9" @if($unit->bathroom == 9) selected @endif>9</option>
                                    <option value="10" @if($unit->bathroom == 10) selected @endif>10</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-group">
                                <label>Bathroom</label>
                                <select class="form-control" name="bathroom">
                                    <option value="1" @if($unit->bathroom == 1) selected @endif>1</option>
                                    <option value="2" @if($unit->bathroom == 2) selected @endif>2</option>
                                    <option value="3" @if($unit->bathroom == 3) selected @endif>3</option>
                                    <option value="4" @if($unit->bathroom == 4) selected @endif>4</option>
                                    <option value="5" @if($unit->bathroom == 5) selected @endif>5</option>
                                </select>
                            </div>
                        </div> --}}
                    </div>
            
                    {{-- <div class="row">
                        <div class="@if(Auth::user()->role == 1) col-md-3 @else col-md-4 @endif">
                            <div class="form-group">
                                <label>Period</label>
                                <select class="form-control" name="period">
                                    <option value="Per Night" @if($unit->period == 'Per Night') selected @endif>Per Night</option>
                                    <option value="Per Day" @if($unit->period == 'Per Day') selected @endif>Per Day</option>
                                </select>
                            </div>
                        </div>
                        <div class="@if(Auth::user()->role == 1) col-md-3 @else col-md-4 @endif">
                            <div class="form-group">
                                <label>Bedroom</label>
                                <select class="form-control" name="bedroom">
                                    <option value="1" @if($unit->bedroom == 1) selected @endif>1</option>
                                    <option value="2" @if($unit->bedroom == 2) selected @endif>2</option>
                                    <option value="3" @if($unit->bedroom == 3) selected @endif>3</option>
                                    <option value="4" @if($unit->bedroom == 4) selected @endif>4</option>
                                    <option value="5" @if($unit->bedroom == 5) selected @endif>5</option>
                                </select>
                            </div>
                        </div>
                    </div> --}}

                    {{-- <hr>
                    <h4>Tour</h4>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Select Tour</label>
                                <select class="form-control" name="tour_id" required>
                                    @foreach($tours as $tour)
                                        <option value="{{ $tour->id }}" @if($unit->tour_id == $tour->id) selected @endif>{{ $tour->title }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div> --}}

                    <hr>
                    <h4>Photos</h4>
                    <div class="form-inline upload_1">
                        <div class="form-group">
                            <input type="file" name="images[]" accept="image/*" multiple>
                        </div>
                    </div>
            
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Description</h4>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <textarea class="form-control" name="description" rows="5">{{ $unit->description }}</textarea>
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
            
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <h4>Facilities</h4>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <ul class="other-features">
                                    <li>
                                        <input type="checkbox" id="air_condition" name="facilities[]" value="Air Conditioning">
                                        <label for="air_condition">Air Conditioning</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="bedding" name="facilities[]" value="Bedding">
                                        <label for="bedding">Bedding</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="balcony" name="facilities[]" value="Balcony">
                                        <label for="balcony">Balcony</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="cable_tv" name="facilities[]" value="Cable TV">
                                        <label for="cable_tv">Cable TV</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="internet" name="facilities[]" value="Internet">
                                        <label for="internet">Internet</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="parking" name="facilities[]" value="Parking">
                                        <label for="parking">Parking</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="lift" name="facilities[]" value="Lift">
                                        <label for="lift">Lift</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="pool" name="facilities[]" value="Pool">
                                        <label for="pool">Pool</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="dishwasher" name="facilities[]" value="Dishwasher">
                                        <label for="dishwasher">Dishwasher</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="toaster" name="facilities[]" value="Toaster">
                                        <label for="toaster">Toaster</label>
                                    </li>
                                    <li>
                                        <input type="checkbox" id="gym" name="facilities[]" value="Gym">
                                        <label for="gym">Gym</label>
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
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Street address</label>
                                <input class="form-control" name="address" id="address" value="{{ $unit->address }}" type="text">
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
                                <input class="form-control" name="latitude" id="map_lan" value="{{ $unit->latitude }}" type="hidden">
                            </div>
                        </div>
                        <div class="col-md-6 mt-2" style="display: none">
                            <div class="form-group">
                                <label>Longitude</label>
                                <input class="form-control" name="longitude" id="map_long" value="{{ $unit->longitude }}" type="hidden">
                            </div>
                        </div>
                    </div>
                    <!-- End row -->

                    <hr>
                    <button type="submit" class="btn-block btn_1 green">Update Hotel Unit</button>
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

<script type="text/javascript" src="{{ asset('assets/app/searchLocation.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/js/infobox.js') }}"></script>
@endsection