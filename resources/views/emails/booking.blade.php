@component('mail::message')
<h1 style="text-align:center;">Caraga Tours</h1>

<strong>Booking Reference:</strong> {{ $data['booking_id'] }}

<strong>Book:</strong> {{ $data['property'] }}

<strong>Checkin Date:</strong> {{ $data['checkin_date'] }}

<strong>Checkout Date:</strong> {{ $data['checkout_date'] }}

<strong>Payment:</strong> {{ $data['payment'] }}

<strong>Client Name:</strong> {{ $data['full_name'] }}

<strong>Email:</strong> {{ $data['email'] }}

<strong>Phone:</strong> {{ $data['phone'] }}
@endcomponent
