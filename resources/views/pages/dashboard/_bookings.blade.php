<div class="row">
    <div class="col-6">
        <h4>List of Bookings</h4>
    </div>
</div>

@forelse($bookings as $booking)
    <div class="strip_booking">
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <div class="date">
                    <span class="month">{{ $booking->checkin_date }}</span>
                    <span class="day">{{ $booking->checkout_date }}</span>
                </div>
            </div>
            <div class="col-lg-6 col-md-5">
                <h3 class="hotel_booking">
                    {{-- @if($booking->tour_id)
                        <a href="{{ route('tours.show', $booking->tour_id) }}" target="_blank">
                            {{ $booking->tour->title ?? '' }}
                        </a>
                    @else
                        <a href="{{ route('hotels.unit.show', $booking->unit_id) }}" target="_blank">
                            {{ $booking->unit->name ?? '' }}
                        </a>
                    @endif --}}
                    <a href="{{ route('hotels.unit.show', $booking->unit_id) }}" target="_blank">
                        Hotel Room: {{ $booking->room->name ?? '' }}
                    </a>
                    <span class="mb-1">Guest: {{ $booking->capacity }}</span>
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
                    @if($booking->is_paid)
                        <li><strong>Payment</strong>Yes - Online Payment</li>
                        @if($booking->gcash)
                            <li><strong>Gcash Reference Number: </strong>{{ $booking->gcash }}</li>
                        @endif
                    @else
                        <li><strong>Payment</strong>No - Pay at the Hotel</li>
                        <div class="booking_buttons">
                            <form action="{{ route('booking.paid') }}" method="POST">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $booking->id }}">
                                <button type="submit" class="btn_2 btn-block">Mark This Booking As Paid</button>
                            </form>
                        </div>
                    @endif
                </ul>
            </div>
            {{-- <div class="col-lg-2 col-md-2">
                <div class="booking_buttons">
                    <a href="#0" class="btn_2">Edit</a>
                    <a href="#0" class="btn_3">Cancel</a>
                </div>
            </div> --}}
        </div>
    </div>
@empty
<h3 class="text-center">You don't have any bookings!</h3>
@endforelse