@extends('layouts.app')

@section('content')
@if(isset($error) && !$error)
<input type="hidden" id="is-intent" value="{{ $intent->client_secret }}">
@endif

<section id="hero_2"
style="background-image: url({{ asset('storage/'.$room->main_photo) }}); background-repeat: no-repeat; background-position: center;"

>
    <div class="intro_title">
        <h1>Place your order</h1>
        <div class="bs-wizard row">

            <div class="col-4 bs-wizard-step complete">
                <div class="text-center bs-wizard-stepnum">Your hotel room</div>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
                <a href="#" class="bs-wizard-dot"></a>
            </div>

            <div class="col-4 bs-wizard-step active">
                <div class="text-center bs-wizard-stepnum">Your details</div>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
                <a href="#" class="bs-wizard-dot"></a>
            </div>

            <div class="col-4 bs-wizard-step disabled">
                <div class="text-center bs-wizard-stepnum">Finish!</div>
                <div class="progress">
                    <div class="progress-bar"></div>
                </div>
                <a href="#" class="bs-wizard-dot"></a>
            </div>

        </div>
        <!-- End bs-wizard -->
    </div>
    <!-- End intro-title -->
</section>

<div id="position">
    <div class="container">
        <ul>
            <li><a href="#">Booking</a>
            </li>
        </ul>
    </div>
</div>
<!-- End position -->

<div class="container margin_60">
    <div class="row">
        <div class="col-lg-8 add_bottom_15">
            <form action="{{ route('booking.hotel.book') }}" method="POST" class="card-form">
                @csrf
                <input type="hidden" name="payment_method" class="payment-method">
                <input type="hidden" name="room_id" value="{{ $room->id }}">
                <input type="hidden" name="price" value="{{ $room->price }}">
                <input type="hidden" name="checkin_date" value="{{ $checkin_date }}">
                <input type="hidden" name="checkout_date" value="{{ $checkout_date }}">
                <input type="hidden" name="totalprice" value="{{ $totalprice }}">
                <input type="hidden" name="capacity" value="{{ $room->capacity }}">
                <div class="form_title">
                    <h3><strong>1</strong>Your Details</h3>
                </div>
                <div class="step">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>First name</label>
                                <input type="text" class="form-control" name="firstname" value="{{ Auth::user()->firstname }}">
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label>Last name</label>
                                <input type="text" class="form-control" name="lastname" value="{{ Auth::user()->lastname }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Telephone</label>
                                <input type="text" id="telephone_booking" name="phone" class="form-control" value="{{ Auth::user()->phone }}">
                            </div>
                        </div>
                    </div>
                </div>

                @if($unit->enable_online_payment)
                    <div class="form_title">
                        <h3><strong>2</strong>Payment Information</h3>
                    </div>
                    <div class="step">
                        <div class="form row">
                            <div class="form-group col-md-6">
                                <button class="btn_1 btn-block green medium pay" type="button" onclick="paymentForm('card')">Pay with Card</button>
                            </div>
                            <div class="form-group col-md-6">
                                <button class="btn_1 btn-block green medium pay" type="button" onclick="paymentForm('gcash')">Pay with Gcash</button>
                            </div>
                        </div>

                        <div class="form row" style="display: none" id="pay-via-card">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input class="StripeElement mb-3 form-control" id="card_holder_name" name="card_holder_name" placeholder="Card holder name">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <div id="card-element" class="form-control"></div>
                                    <div id="card-errors" role="alert"></div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <img src="{{ asset('assets/img/cards.png') }}" width="207" height="43" alt="Cards" class="cards">
                            </div>
                        </div>

                        <div class="form row" style="display: none" id="pay-via-gcash">
                            <div class="col-sm-12">
                                <h4 class="text-center font-weight-bold">Send Your Payment Through Gcash: {{ $owner->gcash }}</h4>
                                <div class="form-group">
                                    <label>Gcash Reference Number</label>
                                    <input type="text" name="gcash" id="gcash" class="form-control" placeholder="Gcash Reference Number">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="policy" style="display: none">
                        <h4>No cancellation policy</h4>
                        <input type="text" name="payment_type" id="payment_type" hidden>
                        <div class="form-group">
                            <label>
                            <input type="checkbox" required name="policy_terms" id="policy_terms"> I accept terms and conditions and general policy.</label>
                        </div>
                        <button type="submit" class="btn_1 green medium pay">Book now</button>
                    </div>
                @else
                    <div class="form_title">
                        <h3><strong>2</strong>Payment Information</h3>
                    </div>
                    <div id="policy">
                        <h4>No Credit Card Needed - Pay At The Hotel</h4>
                        <div class="form-group">
                            <label>
                            <input type="checkbox" required name="policy_terms" id="policy_terms"> I accept terms and conditions and general policy.</label>
                        </div>
                        <button type="submit" class="btn_1 green medium pay">Reserve now</button>
                    </div>
                @endif
            </form>
        </div>

        <aside class="col-lg-4">
            <div class="box_style_1">
                <h3 class="inner">- Summary -</h3>
                <table class="table table_summary">
                    <tbody>
                        <tr>
                            <td>
                                Guest
                            </td>
                            <td class="text-right">
                                {{ $room->capacity }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Hotel Room
                            </td>
                            <td class="text-right">
                                {{ $room->name }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Check in
                            </td>
                            <td class="text-right">
                                {{ $checkin_date }}
                            </td>
                        </tr>
                        <tr>
                            <td>
                                Check out
                            </td>
                            <td class="text-right">
                                {{ $checkout_date }}
                            </td>
                        </tr>
                        <tr class="total">
                            <td>
                                Total cost
                            </td>
                            <td class="text-right">
                                {{ number_format($totalprice, 0) }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="box_style_4">
                <i class="icon_set_1_icon-57"></i>
                <h4>Need <span>Help?</span></h4>
                <a href="tel://+63 936 127 2791" class="phone">+63 936 127 2791</a>
                <small>Monday to Friday 9.00am - 7.30pm</small>
            </div>
        </aside>

    </div>
    <!--End row -->
</div>
<!--End container -->
@endsection

@section('js')
{{\Stripe\Stripe::setVerifySslCerts(false)}}
<script src="https://script.tapfiliate.com/tapfiliate.js" type="text/javascript" async></script>
<script type="text/javascript">
    (function(t,a,p){t.TapfiliateObject=a;t[a]=t[a]||function(){
    (t[a].q=t[a].q||[]).push(arguments)}})(window,'tap');

    tap('create', '21925-8139b9', { integration: "stripe" });
    tap('detect');
</script>
<script src="https://js.stripe.com/v3/"></script>



<script>

function paymentForm(type) {
    $('#policy').show();

    if(type == 'card') {
        $('#payment_type').val('card');
        $('#pay-via-card').show();
        $('#pay-via-gcash').hide();

        $("#card_holder_name").prop('required',true);
        $("#gcash").prop('required',false);
    } 
    else if(type == 'gcash') {
        $('#payment_type').val('gcash');
        $('#pay-via-gcash').show();
        $('#pay-via-card').hide();

        $("#card_holder_name").prop('required',false);
        $("#gcash").prop('required',true);
    }
}
    
if($('#is-intent').val()) {
    let stripe = Stripe("{{ env('STRIPE_KEY') }}");
    let elements = stripe.elements();
    let style = {
        base: {
            color: '#32325d',
            fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
            fontSmoothing: 'antialiased',
            fontSize: '16px',
            '::placeholder': {
                color: '#aab7c4'
            }
        },
        invalid: {
            color: '#fa755a',
            iconColor: '#fa755a'
        }
    }
    let card = elements.create('card', {style: style});
    card.mount('#card-element');
    let paymentMethod = null;

    $('.card-form').on('submit', function (e) {
        if($('#payment_type').val() == 'gcash') {
            return true;
        }
        else {
            let existingCard = parseInt($('#existing-card').val());
            $('button.pay').attr('disabled', true);

            if(existingCard == 1) {
                return true;
            } 
            else {
                if (paymentMethod) {
                    return true;
                }
                stripe.confirmCardSetup(
                    $('#is-intent').val(),
                    {
                        payment_method: {
                            card: card,
                            billing_details: {name: $('#card_holder_name').val()}
                        }
                    }
                ).then(function (result) {
                    if (result.error) {
                        $('#card-errors').text(result.error.message);
                        $('button.pay').removeAttr('disabled');
                    } else {
                        paymentMethod = result.setupIntent.payment_method;
                        $('.payment-method').val(paymentMethod);
                        $('.card-form').submit();
                    }
                });
            }
            return false;
        }
    });
}
</script>
@endsection