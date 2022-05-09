<div class="row">
    <div class="col-6">
        <h4>List of Rooms</h4>
    </div>
    <div class="col-6">
        <a href="{{ route('dashboard.rooms.create') }}" class="btn_1 float-right text-white">Add New Room</a>
    </div>
</div>
{{-- <hr> --}}
<div class="strip_booking">
    <div class="row">
        @foreach($rooms as $room)
            <div class="col-lg-2 col-md-2">
                @if($room->main_photo)
                    <img src="{{ asset('storage/'.$room->main_photo) }}" class="img-fluid styled profile_pic mt-0">
                @else
                    <img src="{{ asset('assets/img/tourist_guide_pic.jpg') }}" class="img-fluid styled profile_pic mt-0">
                @endif
            </div>
            <div class="col-lg-6 col-md-5">
                <h3 class="hotel_booking">{{ $room->name }}<span>₱ {{ $room->price }} / {{ $room->period }}</span></h3>
                <p class="mt-4">{{ $room->description }}</p>
            </div>
            <div class="col-lg-2 col-md-3">               
                <ul class="info_booking">
                    <li><strong>Room Id</strong> {{ $room->id }}</li>
                    <li><strong>Availability</strong>{{ $room->is_available == 1 ? 'YES' : 'NO' }}</li>
                    <li><strong>Capacity</strong>{{ $room->capacity }}</li>
                    <li><strong>Bedroom</strong>{{ $room->bedroom }}</li>
                    <li><strong>Bathroom</strong>{{ $room->bathroom }}</li>
                    <li><strong>Status</strong>
                        @if($room->is_approved)
                        Approved
                    @else
                        Pending
                    @endif
                    </li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-2">
                {{-- @if($room->is_approved and $room->is_available)  
                    <div class="booking_buttons">
                        <a href="{{ route('dashboard.room.show', $room->id) }}" target="_blank" class="btn_2">http://127.0.0.1:8000/</a>
                    </div>
                @endif --}}
                
                <div class="booking_buttons">
                    @if(Auth::user()->role == 1)
                        @if(!$room->is_approved)
                            <form class="mb-1" action="{{ route('dashboard.rooms.approve', $room->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn_2 btn-block">Approve</button>
                            </form>
                        @endif

                        <a href="{{ route('dashboard.rooms.edit', $room->id) }}" class="btn_2 btn-block">Edit</a>
                        <form action="{{ route('dashboard.rooms.destroy', $room->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn_3 btn-block">Delete</button>
                        </form>
                    @elseif(Auth::user()->id == $room->user_id)
                        <a href="{{ route('dashboard.rooms.edit', $room->id) }}" class="btn_2 btn-block">Edit</a>
                        <form action="{{ route('dashboard.rooms.destroy', $room->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn_3 btn-block">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        @endforeach
    </div>
    <!-- End row -->
</div>
