<div class="row">
    <div class="col-6">
        <h4>List of Units</h4>
    </div>
    <div class="col-6">
        <a href="{{ route('dashboard.units.create') }}" class="btn_1 float-right text-white">Add New Unit</a>
    </div>
</div>
{{-- <hr> --}}
<div class="strip_booking">
    <div class="row">
        @foreach($units as $unit)
            <div class="col-lg-2 col-md-2">
                @if($unit->main_photo)
                    <img src="{{ asset('storage/'.$unit->main_photo) }}" class="img-fluid styled profile_pic mt-0">
                @else
                    <img src="{{ asset('assets/img/tourist_guide_pic.jpg') }}" class="img-fluid styled profile_pic mt-0">
                @endif
            </div>
            <div class="col-lg-6 col-md-5">
                <h3 class="hotel_booking">{{ $unit->name }}<span>₱ {{ $unit->price }} / {{ $unit->period }}</span></h3>
                <p class="mt-4">{{ $unit->description }}</p>
            </div>
            <div class="col-lg-2 col-md-3">
                <ul class="info_booking">
                    <li><strong>Room Id</strong> {{ $unit->unit_id }}</li>
                    <li><strong>Availability</strong>{{ $unit->is_availabe == 1 ? 'YES' : 'NO' }}</li>
                    <li><strong>Capacity</strong>{{ $unit->capacity }}</li>
                    <li><strong>Bedroom</strong>{{ $unit->bedroom }}</li>
                    <li><strong>Bathroom</strong>{{ $unit->bathroom }}</li>
                </ul>
            </div>
            <div class="col-lg-2 col-md-2">
                <div class="booking_buttons">
                    <a href="#0" class="btn_2">View</a>
                    {{-- <a href="#0" class="btn_2">View</a> --}}
                    <form action="{{ route('dashboard.units.destroy', $unit->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn_3 btn-block">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
    <!-- End row -->
</div>
<!-- End strip booking -->