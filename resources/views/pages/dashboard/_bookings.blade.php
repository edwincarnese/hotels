<div class="row">
    <div class="col-6">
        <h4>List of Bookings</h4>
    </div>
</div>

@foreach($bookings as $booking)
    <div class="strip_booking">
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <div class="date">
                    <span class="month">{{ $booking->checkin_date }}</span>
                    <span class="day">{{ $booking->checkout_date }}</span>
                </div>
            </div>
            <div class="col-lg-6 col-md-5">
                <h3 class="hotel_booking">{{ $bookings[0]->unit->name ?? '' }}
                    <span class="mb-1">{{ $booking->adult }} Adults / {{ $booking->children }} Children</span>
                    <span class="mb-1">Details: {{ $booking->firstname }} {{ $booking->lastname }}</span>
                    <span>Contact: {{ $booking->phone }}</span>
                </h3>
            </div>
            <div class="col-lg-4 col-md-3">
                <ul class="info_booking">
                    <li><strong>Booking Payment</strong>{{ $booking->payment }}</li>
                    <li><strong>Booking id</strong>000{{ $booking->id }}</li>
                    <li><strong>Check in</strong>{{ $booking->checkin_date }}</li>
                    <li><strong>Check out</strong>{{ $booking->checkout_date }}</li>
                </ul>
            </div>
            {{-- <div class="col-lg-2 col-md-2">
                <div class="booking_buttons">
                    <a href="#0" class="btn_2">Edit</a>
                    <a href="#0" class="btn_3">Cancel</a>
                </div>
            </div> --}}
        </div>
        <!-- End row -->
    </div>
@endforeach