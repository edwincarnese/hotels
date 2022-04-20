<div class="row">
    <div class="col-6">
        <h4>List of Tours</h4>
    </div>
    <div class="col-6">
        <a href="{{ route('dashboard.tours.create') }}" class="btn_1 float-right text-white">Add New Tour</a>
    </div>
    
</div>
{{-- <hr> --}}
<div class="strip_booking">
    <div class="row">
        @foreach($tours as $tour)
            <div class="col-lg-2 col-md-2">
                @if($tour->main_photo)
                    <img src="{{ asset('storage/'.$tour->main_photo) }}" class="img-fluid styled profile_pic mt-0">
                @else
                    <img src="{{ asset('assets/img/tourist_guide_pic.jpg') }}" class="img-fluid styled profile_pic mt-0">
                @endif
            </div>
            <div class="col-lg-6 col-md-5">
                <h3 class="tours_booking">{{ $tour->title }}<span></span></h3>
                <p class="mt-4">{{ $tour->description }}</p>
            </div>
            <div class="col-lg-2 col-md-3">
                <ul class="info_booking">
                    <li><strong>Status</strong>
                        @if($tour->is_approved)
                            Approved
                        @else
                            Pending
                        @endif
                    </li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-2">
                @if($tour->is_approved)
                    <div class="booking_buttons">
                        <a href="{{ route('tours.show', $tour->id) }}" target="_blank" class="btn_2">View</a>
                    </div>
                    <div class="booking_buttons">
                        <a href="{{ route('dashboard.units.create', ['tour' => $tour->id]) }}" target="_blank" class="btn_2">Add New Hotel Unit</a>
                        <br>
                        <a href="{{ route('dashboard.rooms.create', ['tour' => $tour->id])  }}" target="_blank" class="btn_2"> Add New Room</a>
                   
                    </div>
                 
                @endif
                
                @if(Auth::user()->role == 1)
                    <div class="booking_buttons">
                        @if(!$tour->is_approved)
                            <form class="mb-1" action="{{ route('dashboard.tours.approve', $tour->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn_2 btn-block">Approve</button>
                            </form>
                        @endif
                        <a href="{{ route('dashboard.tours.edit', $tour->id) }}" class="btn_2 btn-block">Edit</a>
                        <form action="{{ route('dashboard.tours.destroy', $tour->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn_3 btn-block">Delete</button>
                        </form>
                    </div>
                @endif
            </div>
        @endforeach
    </div>
    <!-- End row -->
</div>
<!-- End strip booking -->