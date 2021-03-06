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
                <h4>Create Rooms</h4>
            </div>
            <div class="col-6">
                <a href="{{ route('dashboard.index') }}" class="btn_1 float-right text-white">Cancel</a>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
                <form method="POST" action="{{ route('dashboard.rooms.store') }}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="unit_id" value="{{$unit_id}}">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input class="form-control" name="name" type="text" required>
                            </div>
                        </div>
                        {{-- <div class="col-md-3">
                            <div class="form-group">
                                <label>Room ID</label>
                                <input class="form-control" name="unit_id" type="text" required>
                            </div>
                        </div> --}}
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Capacity</label>
                                <select class="form-control" name="capacity">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Bathroom</label>
                                <select class="form-control" name="bathroom">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                    </div>
            
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Price</label>
                                <input class="form-control" name="price" type="text">
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Period</label>
                                <select class="form-control" name="period">
                                    <option value="Per Night">Per Night</option>
                                    <option value="Per Day">Per Day</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Bedroom</label>
                                <select class="form-control" name="bedroom">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label>Availability</label>
                                <select class="form-control" name="is_available">
                                    <option value="1">Available</option>
                                    <option value="0">Not Available</option>
                                </select>
                            </div>
                        </div>
                    </div>

                                 
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
                                <textarea class="form-control" name="description" rows="5"></textarea>
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
                    <hr>
                    <button type="submit" class="btn-block btn_1 green">Create Room</button>
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
@endsection