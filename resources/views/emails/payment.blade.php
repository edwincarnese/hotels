@component('mail::message')
<h1 style="text-align:center;">Caraga Tours</h1>

<strong>Full Name:</strong> {{ $data['full_name'] }}

<strong>Payment:</strong> {{ $data['payment'] }}

<strong>Mode of Payment:</strong> {{ $data['mode_of_payment'] }}

@endcomponent
