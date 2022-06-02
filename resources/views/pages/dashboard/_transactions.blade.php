<div class="row">
    <div class="col-6">
        <h4>List of Transactions</h4>
    </div>
</div>

@foreach($transactions as $transaction)
    <div class="strip_booking">
        <div class="row">
            <div class="col-lg-2 col-md-2">
                <div class="date">
                    <span class="month">{{ $transaction->created_at }}</span>
                </div>
            </div>
            <div class="col-lg-6 col-md-5">
                
                <h3 class="hotel_booking">
                    {{-- @if($transaction->tour_id)
                        <a href="{{ route('tours.show', $transaction->tour_id) }}" target="_blank">
                            {{ $transaction->tour->title ?? '' }}
                        </a>
                    @elseif($transaction->unit_id)
                        <a href="{{ route('hotels.unit.show', $transaction->unit_id) }}" target="_blank">
                            {{ $transaction->unit->name ?? '' }}
                        </a>
                    @else
                        <a href="{{ route('hotels.unit.show', $transaction->room_id) }}" target="_blank">
                            {{ $transaction->unit->name ?? '' }}
                        </a>
                    @endif --}}
                    <a href="{{ route('hotels.unit.show', $transaction->unit_id) }}" target="_blank">
                        Hotel Room: {{ $transaction->room->name ?? '' }}
                    </a>
                    <span class="mb-1">Owner: {{ $transaction->user->firstname ?? '' }} {{ $transaction->user->lastname ?? '' }}</span>
                    <span class="mb-1">Price: {{ $transaction->price }}</span>
                    <span class="mb-1">Business Tax: {{ $transaction->business_tax }}</span>
                    <span class="mb-1">Payment: {{ $transaction->payment }}</span>
                    <span class="mb-1">Payment Method: {{ $transaction->payment_method }}</span>
                </h3>
            </div>
            <div class="col-lg-4 col-md-3">
                <ul class="info_booking">
                    <li><strong>Is Paid</strong>
                    @if($transaction->is_paid)
                        Yes
                    @else
                        No
                    @endif
                    </li>
                    @if($transaction->mode_of_payment)
                        <li><strong>Mode Of Payment</strong>
                            {{ $transaction->mode_of_payment }}
                        </li>
                    @endif
                </ul>
                @if(!$transaction->is_paid)
                    <div class="booking_buttons">
                        <a href="{{ route('dashboard.transaction.show', $transaction->id) }}" class="btn_2">Transfer Payment</a>
                    </div>
                @endif
            </div>
        </div>
        <!-- End row -->
    </div>
@endforeach