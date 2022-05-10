<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Unit;
use App\Models\Booking;
use App\Mail\BookingMail;
use App\Mail\ConfirmationMail;
use App\Models\User;
use App\Models\Transaction;
use Auth;
use Carbon\Carbon;

class BookingController extends Controller
{
  public function show(Request $request, $id)
  {
    $adult = $request->adult;
    $children = $request->children;
    $checkin_date = $request->checkin_date;
    $checkout_date = $request->checkout_date;

    $from_date = Carbon::parse(date('Y-m-d', strtotime($checkin_date))); 
    $through_date = Carbon::parse(date('Y-m-d', strtotime($checkout_date))); 
    $days = $from_date->diffInDays($through_date);

    if(!$days) {
      $days = 1;
    }

    $user = Auth::user();

    $curl = new \Stripe\HttpClient\CurlClient([CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1]);
    $curl->setEnableHttp2(false);
    \Stripe\ApiRequestor::setHttpClient($curl);

    try
    {
      $data = [
        'error' => FALSE,
        'intent' => $user->createSetupIntent(),
      ];

    }
    catch(\Exception $e)
    {
      $data = [
        'error' => 'Loading Tracking Service, Please check back in 5 minutes...'
      ];
    }

    $unit = Unit::where('id', $id)->first();
    $subtotal = $unit->price;
    $totalprice = $subtotal * $days;

    return view('pages.booking', compact(
      'unit', 
      'adult', 
      'children', 
      'checkin_date', 
      'checkout_date',
      'totalprice')
    )->with($data);
  }

  public function book(Request $request)
  {
    $user = Auth::user();
    $unit = Unit::where('id', $request->unit_id)->first();
    $owner = User::find($unit->user_id);

    $curl = new \Stripe\HttpClient\CurlClient([CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1]);
    $curl->setEnableHttp2(false);
    \Stripe\ApiRequestor::setHttpClient($curl);

    $price = $request->totalprice;
    $payment_method = $request->payment_method;
    $save_card = $request->save_card;
    $not_using_default_card = true;

    try {
      $user->createOrGetStripeCustomer();
      if($not_using_default_card) {
        if($save_card) {
          $user->updateDefaultPaymentMethod($payment_method);
        } else {
          $user->addPaymentMethod($payment_method);
        }
      }
      $user->charge($price * 100, $payment_method);
      $user->save();

      $booking = new Booking();
      $booking->unit_id = $unit->id;
      $booking->owner_id = $unit->user_id;
      $booking->user_id = $user->id;
      $booking->firstname = $request->firstname;
      $booking->lastname = $request->lastname;
      $booking->phone = $request->phone;
      $booking->payment = $request->totalprice;
      $booking->capacity = $request->adult;
      $booking->checkin_date = $request->checkin_date;
      $booking->checkout_date = $request->checkout_date;
      $booking->save();

      $business_tax = $request->totalprice * 0.03;

      $transaction = new Transaction();
      $transaction->user_id = $unit->user_id;
      $transaction->tour_id = null;
      $transaction->unit_id = $unit->id;
      $transaction->price = $request->totalprice;
      $transaction->business_tax = $business_tax;
      $transaction->payment = $request->totalprice - $business_tax;
      $transaction->save();

      $booking_info = array(
        'full_name' => Auth::user()->firstname . ' ' . Auth::user()->lastname,
        'email' => Auth::user()->email,
        'phone' => Auth::user()->phone,
        'booking_id' => $booking->id,
        'payment' => $request->totalprice,
        'checkin_date' => $booking->checkin_date,
        'checkout_date' => $booking->checkout_date,
        'property' => $unit->name,
      );

      $confirmation_info = array(
        'full_name' => $owner->firstname . ' ' . $owner->lastname,
        'email' => $owner->email,
        'phone' => $owner->phone,
        'booking_id' => $booking->id,
        'payment' => $request->totalprice,
        'checkin_date' => $booking->checkin_date,
        'checkout_date' => $booking->checkout_date,
        'property' => $unit->name,
      );

      Mail::to($owner->email)->send(new BookingMail($booking_info));
      Mail::to($user->email)->send(new ConfirmationMail($confirmation_info));
    } 
    catch (\Exception $exception) {
      return back()->with('error', $exception->getMessage());
    }

    return redirect()->route('dashboard.index')->with('success','You have successfully booked this property');
  }
}
