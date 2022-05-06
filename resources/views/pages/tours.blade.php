@extends('layouts.app')

@section('content')
<section class="parallax-window" 
    style="background-image: url({{ asset('assets/img/notify_img.jpg') }}); background-repeat: no-repeat; background-position: center;"
    data-parallax="scroll" 
    data-image-src="{{ asset('assets/img/hotels_bg.jpg') }}" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
            <h1>Discover Our Tours</h1>
            <p>Ridiculus sociosqu cursus neque cursus curae ante scelerisque vehicula.</p>
        </div>
    </div>
</section>
 
    
</section>

<div id="position">
    <div class="container">
        <ul>
            <li><a href="#">Hotels</a>
            </li>
        </ul>
    </div>
</div>
<!-- Position -->

<div class="collapse" id="collapseMap">
    <div id="map" class="map"></div>
    <button type="button" onclick="findMe()" class="btn_1 medium btn-block">Near Me</button>
</div>
<!-- End Map -->

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
                    <form method="GET" action="{{ route('tours.index') }}">
                        <div class="filter_type mt-2 mb-2">
                            <input type="text" name="search" class="form-control" placeholder="Search">
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
                <a href="tel://004542344599" class="phone">+63 9361 272 791</a>
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

			@foreach($tours as $tour)
            <div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s">
                <div class="row">
					<div class="col-lg-4 col-md-4">
                        @if($tour->is_popular)
                            <div class="ribbon_3 popular"><span>Popular</span></div>
                        @endif
						{{-- <div class="wishlist">
							<a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
						</div> --}}
						<div class="img_list">
							<a href="{{ route('tours.show', $tour->id) }}">
								@if($tour->main_photo)
									<img src="{{ asset('storage/'.$tour->main_photo) }}" alt="Image">
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
							{{-- <div class="score"><span>{{ floor($tour->review) }}</span>
							</div> --}}
							{{-- <div class="rating">
                                <i class="icon-star voted"></i>
                                <i class="icon-star voted"></i>
                                <i class="icon-star voted"></i>
                                <i class="icon-star voted"></i>
                                <i class="icon-star"></i>
							</div> --}}
                   
                            <div class="rating">                      
                                @if($tour->review)                                   
                                    @for($rate = 1; $rate <= $tour->review; $rate++)
                                    <i class="icon-star voted"></i>
                               
                                    @endfor
        
                                    @for($rate=$tour->review; $rate<5; $rate++)
                                    <i class="icon-star"></i>
                                    @endfor
        
                                @endif                              
                            </div>
                          



							<h3><strong>{{ $tour->title }}</strong></h3>
							<p>{{ $tour->description }}</p>
							<ul class="add_info">
								
								<li>
									<div class="tooltip_styled tooltip-effect-4">
										<span class="tooltip-item"><i class="icon_set_1_icon-83"></i></span>
									</div>
								</li>
								<li>
									<div class="tooltip_styled tooltip-effect-4">
										<span class="tooltip-item"><i class="icon_set_1_icon-41"></i></span>
									</div>
								</li>
								<li>
									<div class="tooltip_styled tooltip-effect-4">
										<span class="tooltip-item"><i class="icon_set_1_icon-97"></i></span>
									</div>
								</li>
								<li>
									<div class="tooltip_styled tooltip-effect-4">
										<span class="tooltip-item"><i class="icon_set_1_icon-27"></i></span>
									</div>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-lg-2 col-md-2">
						<div class="price_list">
							<div>
                                <sup>₱{{ $tour->price }}</sup>
                                <small></small>
								<p>
									<a href="{{ route('tours.show', $tour->id) }}" class="btn_1">Details</a>
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
<input type="hidden" id="pages-home" value="{{ route('tours.index') }}">
@endsection

@section('js')
<script>
    const urlTourEndpoint = '/tours/';
    const locationDataTours = {!! $tours !!};
    const locationDataHotels = null;
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