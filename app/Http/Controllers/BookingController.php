<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Unit;
use App\Models\Booking;
use App\Models\Room;
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

    $room = Room::where('id', $id)->first();
    $owner = User::find($room->user_id);
    $subtotal = $room->price;
    $totalprice = $subtotal * $days;

    $unit = Unit::where('id', $room->unit_id)->first();

    return view('pages.booking', compact(
      'room', 
      'checkin_date', 
      'checkout_date',
      'totalprice',
      'unit',
      'owner'
    ))->with($data);
  }

  public function book(Request $request)
  {
    $user = Auth::user();
    $room = Room::where('id', $request->room_id)->first();
    $owner = User::find($room->user_id);

    $unit = Unit::where('id', $room->unit_id)->first();

    if($unit->enable_online_payment) {
      $curl = new \Stripe\HttpClient\CurlClient([CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1]);
      $curl->setEnableHttp2(false);
      \Stripe\ApiRequestor::setHttpClient($curl);

      $price = $request->totalprice;
      $payment_method = $request->payment_method;
      $save_card = $request->save_card;
      $not_using_default_card = true;

      try {
        if($request->payment_type == 'card') {
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
        }

        $booking = new Booking();
        $booking->room_id = $room->id;
        $booking->unit_id = $room->unit_id;
        $booking->owner_id = $room->user_id;
        $booking->user_id = $user->id;
        $booking->firstname = $request->firstname;
        $booking->lastname = $request->lastname;
        $booking->phone = $request->phone;
        $booking->payment = $request->totalprice;
        $booking->capacity = $room->capacity;
        $booking->checkin_date = $request->checkin_date;
        $booking->checkout_date = $request->checkout_date;
        if($request->payment_type == 'gcash') {
          $booking->gcash = $request->gcash;
          $booking->is_paid = 0;
        }
        $booking->save();

        if($request->payment_type != 'gcash') {
          $business_tax = $request->totalprice * 0.03;
  
          $transaction = new Transaction();
          $transaction->user_id = $room->user_id;
          $transaction->tour_id = null;
          $transaction->unit_id = $room->unit_id;
          $transaction->room_id = $room->id;
          $transaction->price = $request->totalprice;
          $transaction->business_tax = $business_tax;
          $transaction->payment = $request->totalprice - $business_tax;
          $transaction->payment_method = 'Credit/Debit Card';
          $transaction->save();
        }

        $booking_info = array(
          'full_name' => $request->firstname . ' ' . $request->lastname,
          'email' => Auth::user()->email,
          'phone' => $request->phone,
          'booking_id' => $booking->id,
          'payment' => $request->totalprice,
          'checkin_date' => $booking->checkin_date,
          'checkout_date' => $booking->checkout_date,
          'property' => $room->name,
        );

        $confirmation_info = array(
          'full_name' => $owner->firstname . ' ' . $owner->lastname,
          'email' => $owner->email,
          'phone' => $owner->phone,
          'booking_id' => $booking->id,
          'payment' => $request->totalprice,
          'checkin_date' => $booking->checkin_date,
          'checkout_date' => $booking->checkout_date,
          'property' => $room->name,
        );

        // Mail::to($owner->email)->send(new BookingMail($booking_info));
        // Mail::to($user->email)->send(new ConfirmationMail($confirmation_info));
      } 
      catch (\Exception $exception) {
        // dd($exception);
      }
    }
    else {
      $booking = new Booking();
      $booking->unit_id = $room->unit_id;
      $booking->room_id = $room->id;
      $booking->owner_id = $room->user_id;
      $booking->user_id = $user->id;
      $booking->firstname = $request->firstname;
      $booking->lastname = $request->lastname;
      $booking->phone = $request->phone;
      $booking->payment = $request->totalprice;
      $booking->capacity = $room->capacity;
      $booking->checkin_date = $request->checkin_date;
      $booking->checkout_date = $request->checkout_date;
      $booking->is_paid = 0;
      $booking->save();

      $booking_info = array(
        'full_name' => $request->firstname . ' ' . $request->lastname,
        'email' => Auth::user()->email,
        'phone' => $request->phone,
        'booking_id' => $booking->id,
        'payment' => $request->totalprice,
        'checkin_date' => $booking->checkin_date,
        'checkout_date' => $booking->checkout_date,
        'property' => $room->name,
      );

      $confirmation_info = array(
        'full_name' => $owner->firstname . ' ' . $owner->lastname,
        'email' => $owner->email,
        'phone' => $owner->phone,
        'booking_id' => $booking->id,
        'payment' => $request->totalprice,
        'checkin_date' => $booking->checkin_date,
        'checkout_date' => $booking->checkout_date,
        'property' => $room->name,
      );

      Mail::to($owner->email)->send(new BookingMail($booking_info));
      Mail::to($user->email)->send(new ConfirmationMail($confirmation_info));
    }

    return redirect()->route('dashboard.index')->with('success','You have successfully booked this property');
  }

  public function bookingPaid(Request $request)
  {
    $booking = Booking::where('id', $request->booking_id)->first();

    $booking->is_paid = 1;
    $booking->save();

    return redirect()->route('dashboard.index')->with('success','You have successfully marked this booking as paid');
  }
}
