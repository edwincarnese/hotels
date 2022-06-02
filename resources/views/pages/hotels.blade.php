@extends('layouts.app')

@section('content')
<section class="parallax-window"  style="background-image: url({{ asset('assets/img/hotels_bg.jpg') }}); background-repeat: no-repeat; background-position: center;"
 data-parallax="scroll" 
data-image-src="img/hotels_bg.jpg" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
            <h1>Discover Our Hotels</h1>
            {{-- <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p> --}}
        </div>
    </div>
</section>

<div id="position">
    <div class="container">
        <ul>
            <li><a href="/hotels">Hotels</a>
            </li>
        </ul>
    </div>
</div>
<!-- Position -->

<div class="collapse" id="collapseMap">
<div id="map" class="map"></div>
<button type="button" onclick="findMe()" class="btn_1 medium btn-block">Near Me</button>
</div>


<div class="container margin_60">

    <div class="row">
        <aside class="col-lg-3">
            <p>
                <a class="btn_map" data-toggle="collapse" href="#collapseMap" aria-expanded="false" aria-controls="collapseMap" data-text-swap="Hide map" data-text-original="View on map">View on map</a>
            </p>

            <div id="filters_col">
                {{-- <a data-toggle="collapse" href="#collapseFilters" aria-expanded="false" aria-controls="collapseFilters" id="filters_col_bt"><i class="icon_set_1_icon-65"></i>Filters</a> --}}
                <div class="collapse show" id="collapseFilters">
                    {{-- <div class="filter_type">
                        <h6>Price</h6>
                        <input type="text" id="range" name="range" value="">
                    </div> --}}
                    {{-- <div class="filter_type">
                        <h6>Facility</h6>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox">Pet allowed
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">Wifi
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">Spa
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">Restaurant
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">Pool
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">Parking
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">Fitness center
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="filter_type">
                        <h6>District</h6>
                        <ul>
                            <li>
                                <label>
                                    <input type="checkbox">Paris Centre
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">La Defance
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">La Marais
                                </label>
                            </li>
                            <li>
                                <label>
                                    <input type="checkbox">Latin Quarter
                                </label>
                            </li>
                        </ul>
                    </div> --}}
                    <form method="GET" action="{{ route('hotels.index') }}">
                        <div class="filter_type mt-2 mb-2">
                            <input type="text" name="name" class="form-control" placeholder="Name" value="{{ Request::get('name') }}">
                        </div>
                        <div class="filter_type mt-2 mb-2">
                            <input type="text" name="min_price" class="form-control" placeholder="Min. Price" value="{{ Request::get('min_price') }}">
                        </div>
                        <div class="filter_type mt-2 mb-2">
                            <input type="text" name="max_price" class="form-control" placeholder="Max. Price" value="{{ Request::get('max_price') }}">
                        </div>
                        <div>
                            <button class="btn_1 btn-block">Search</button>
                        </div>
                    </form>
                </div>
                <!--End collapse -->
            </div>
            <!--End filters col-->
            <div class="box_style_2">
                <i class="icon_set_1_icon-57"></i>
                <h4>Need <span>Help?</span></h4>
                <a href="tel://639361272791" class="phone">+63 936 127 2791</a>
                <small>Monday to Friday 9.00am - 7.30pm</small>
            </div>
        </aside>
        <!--End aside -->

        <div class="col-lg-9">

            {{-- <div id="tools">
                <div class="row">
                    <div class="col-md-3 col-sm-4 col-6">
                        <div class="styled-select-filters">
                            <select name="sort_price" id="sort_price">
                                <option value="" selected>Sort by price</option>
                                <option value="lower">Lowest price</option>
                                <option value="higher">Highest price</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-4 col-6" style="visibility: hidden">
                        <div class="styled-select-filters">
                            <select name="sort_rating" id="sort_rating">
                                <option value="" selected>Sort by ranking</option>
                                <option value="lower">Lowest ranking</option>
                                <option value="higher">Highest ranking</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-4 d-none d-sm-block text-right">
                        <a href="#" class="bt_filters"><i class="icon-th"></i></a> 
                        <a href="#" class="bt_filters"><i class=" icon-list"></i></a>
                    </div>
                </div>
            </div> --}}
            <!--End tools -->

			@foreach($units as $unit)
            <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                <div class="row">
					<div class="col-lg-4 col-md-4">
                        @if($unit->is_popular)
                            <div class="ribbon_3 popular"><span>Popular</span></div>
                        @endif
						{{-- <div class="wishlist">
							<a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
						</div> --}}
						<div class="img_list">
							<a href="{{ route('hotels.unit.show', $unit->id) }}">
								@if($unit->main_photo)
									<img src="{{ asset('storage/'.$unit->main_photo) }}" alt="Image">
								@else
									<img src="{{ asset('assets/img/tourist_guide_pic.jpg') }}">
								@endif
								<div class="short_info"></div>
							</a>
						</div>
					</div>
					<div class="clearfix visible-xs-block"></div>
					<div class="col-lg-6 col-md-6">
						<div class="tour_list_desc">
							{{-- <div class="score">Very Good<span>{{$unit->review}}</span>
							</div> --}}
							{{-- <div class="rating">
                                <i class="icon-star voted"></i>
                                <i class="icon-star voted"></i>
                                <i class="icon-star voted"></i>
                                <i class="icon-star voted"></i>
                                <i class="icon-star voted"></i>
							</div> --}}
                            <div class="rating">                      
                                @if($unit->review)                                   
                                    @for($rate = 1; $rate <= $unit->review; $rate++)
                                    <i class="icon-star voted"></i>
                               
                                    @endfor
        
                                    @for($rate=$unit->review; $rate<5; $rate++)
                                    <i class="icon-star"></i>
                                    @endfor
        
                                @endif                              
                            </div>

							<h3><strong>{{ $unit->name }}</strong></h3>
							<p>Location: {{ $unit->address }}</p>
							{{-- <ul class="add_info">
								<li>
									<a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Free Wifi"><i class="icon_set_1_icon-86"></i></a>
								</li>
								<li>
									<a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Plasma TV with cable channels"><i class="icon_set_2_icon-116"></i></a>
								</li>
								<li>
									<a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Swimming pool"><i class="icon_set_2_icon-110"></i></a>
								</li>
								<li>
									<a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Fitness Center"><i class="icon_set_2_icon-117"></i></a>
								</li>
								<li>
									<a href="javascript:void(0);" class="tooltip-1" data-placement="top" title="Restaurant"><i class="icon_set_1_icon-58"></i></a>
								</li>
							</ul> --}}
						</div>
					</div>
					<div class="col-lg-2 col-md-2">
						<div class="price_list">
							<div>
                                {{-- <small>From</small>
								<sup>₱</sup>{{ number_format($unit->price, 0) }} --}}
								{{-- <small class="mt-3">{{ $unit->period }}</small> --}}
								<p class="mt-3">
									<a href="{{ route('hotels.unit.show', $unit->id) }}" class="btn_1">Details</a>
								</p>
							</div>
						</div>
					</div>
                </div>
            </div>
			@endforeach
            <!--End strip -->

            <hr>

            {{-- <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                            <span class="sr-only">Previous</span>
                        </a>
                    </li>
                    <li class="page-item active"><span class="page-link">1<span class="sr-only">(current)</span></span>
                    </li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                            <span class="sr-only">Next</span>
                        </a>
                    </li>
                </ul>
            </nav> --}}
            <!-- end pagination-->

        </div>
        <!-- End col lg-9 -->
    </div>
    <!-- End row -->
</div>
<!-- End container -->
<input type="hidden" id="pages-home" value="{{ route('hotels.index') }}">
@endsection

@section('js')


<script>
const urlEndpoint = '/hotels-unit/';
const locationDataHotels = {!! $units !!};
const locationDataTours = null;
</script>

<script type="text/javascript" src="{{ asset('assets/js/infobox.js') }}"></script>
<script type="text/javascript" src="{{ asset('assets/app/shared.js') }}"></script>

<!-- Check box and radio style iCheck -->
<script>
    $('input').iCheck({
       checkboxClass: 'icheckbox_square-grey',
       radioClass: 'iradio_square-grey'
     });
</script>
@endsection