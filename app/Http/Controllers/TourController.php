<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Tour;
use App\Models\Unit;
use App\Models\User;
use App\Models\Review;
use App\Models\Room;
use App\Models\Booking;
use App\Models\Transaction;
use App\Mail\BookingMail;
use App\Mail\ConfirmationMail;
use Auth;
use DB;
use Carbon\Carbon;

class TourController extends Controller
{

    public function book_store(Request $request)
    {
      $user = Auth::user();
      $tour = Tour::where('id', $request->tour_id)->first();
      $owner = User::find($tour->user_id);

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
        $booking->tour_id = $tour->id;
        $booking->owner_id = $tour->user_id;
        $booking->user_id = $user->id;
        $booking->firstname = $request->firstname;
        $booking->lastname = $request->lastname;
        $booking->phone = $request->phone;
        $booking->payment = $request->totalprice;
        $booking->checkin_date = $request->checkin_date;
        $booking->checkout_date = $request->checkout_date;
        $booking->save();

        $business_tax = $request->totalprice * 0.03;

        $transaction = new Transaction();
        $transaction->user_id = $tour->user_id;
        $transaction->tour_id = $tour->id;
        $transaction->unit_id = null;
        $transaction->price = $request->totalprice;
        $transaction->business_tax = $business_tax;
        $transaction->payment = $request->totalprice - $business_tax;
        $transaction->save();

        $booking_info = array(
          'full_name' =>  Auth::user()->firstname . ' ' . Auth::user()->lastname,
          'email' => Auth::user()->email,
          'phone' => Auth::user()->phone,
          'booking_id' => $booking->id,
          'payment' => $request->totalprice,
          'checkin_date' => $booking->checkin_date,
          'checkout_date' => $booking->checkout_date,
          'property' => $tour->title,
        );
  
        $confirmation_info = array(
          'full_name' => $owner->firstname . ' ' . $owner->lastname,
          'email' => $owner->email,
          'phone' => $owner->phone,
          'booking_id' => $booking->id,
          'payment' => $request->totalprice,
          'checkin_date' => $booking->checkin_date,
          'checkout_date' => $booking->checkout_date,
          'property' => $tour->title,
        );
  
        Mail::to($owner->email)->send(new BookingMail($booking_info));
        Mail::to($user->email)->send(new ConfirmationMail($confirmation_info));
      } 
      catch (\Exception $exception) {
        // dd($exception);
      }

      return redirect()->route('dashboard.index')->with('success','You have successfully booked this tour');
    }

    public function book(Request $request, $id)
    {
      $adult = $request->adult;
      $children = $request->children;
      $checkin_date = $request->checkin_date;
      $checkout_date = $request->checkout_date;
 
      $from_date = Carbon::parse(date('Y-m-d', strtotime($checkin_date))); 
      $through_date = Carbon::parse(date('Y-m-d', strtotime($checkout_date))); 
      $days = $from_date->diffInDays($through_date);
   
      // dd($shift_difference );

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
  
      $tour = Tour::where('id', $id)->first();
      $subtotal = $tour->price;
      $totalprice = $subtotal * $days;
  
      return view('pages.dashboard.tours.booking', compact(
        'tour', 
        'adult', 
        'children', 
        'checkin_date', 
        'checkout_date',
        'totalprice')
      )->with($data);
    }

    public function index(Request $request)
    {
        $name = $request->name;
        $min_price = $request->min_price;
        $max_price = $request->max_price;
       
        $tours = Tour::query()
            ->with('user')
            ->withCount([
              'reviews AS review' => function ($query) {
                  $query->select(DB::raw("(SUM(rate) / COUNT(id)) as review"));
                }
            ])
            ->when($name, function($q) use($name) {
                $q->where('title', 'LIKE', '%'.$name.'%');
            })
            ->when($min_price && $max_price, function($q) use($min_price, $max_price) {
                $q->whereBetween('price', [(int)$min_price, (int)$max_price]);
            })
            ->where('is_approved', 1)
            ->latest()
            ->get();
          
        return view('pages.tours', compact('tours'));
        
        
    }

    public function edit($id)
    {
        $tour = Tour::find($id);
        
        return view('pages.dashboard.tours.edit', compact('tour'));
    }

    public function show($id)
    {
        $users = Auth::user();

        $tour = Tour::query()
            ->with('user')
            ->where('id', $id)
            ->where('is_approved', 1)
            ->firstOrFail();

        $tours = Tour::query()
            ->with('user')
            ->where('id', $id)
            ->where('is_approved', 1)
            ->get();

        $units = Unit::query()
            ->with('user')
            ->where('is_approved', 1)
            ->where('tour_id', $tour->id)
            ->latest()
            ->get();

        $rooms = Room::query()
            ->where('is_approved', 1)
            ->where('tour_id',$id)
            ->get();

        $tour_id = $tour->id;
        $unit_id = '';
        
        $reviews = Review::with('user')->where('tour_id', $tour_id)->latest()->get();
        
        $tour_ratings= Tour::query()
        ->withCount([
          'reviews AS review' => function ($query) {
              $query->select(DB::raw("(SUM(rate) / COUNT(id)) as review"));
              }
          ])->latest()->get();
      
        return view('pages.tours-hotels', compact('tour', 'tours', 'units', 'tour_id', 'unit_id', 'reviews','rooms','tour_ratings'));
    }

    public function create()
    {
        return view('pages.dashboard.tours.create');
    }

    public function update(Request $request)
    {
        $tour = Tour::find($request->id);

        $data = $request->all();

        if($request->amenities) {
            $data['amenities'] = json_encode($request->amenities);
        }

        if($request->images) {
            $images = $request->images;
            $uploaded_images = [];

            foreach($images as $key => $image) {
                $imageName = $key.time().'.'.$image->getClientOriginalExtension();  
                $image->storeAs('images', $imageName, 'public');

                $imagePath = 'images/'.$imageName;

                array_push($uploaded_images, $imagePath);
            }

            $data['images'] = json_encode($uploaded_images);
        }

        $tour->update($data);

        return redirect()->route('dashboard.index')->with('success', 'Your tour has been successfully update.');
    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();

        if($request->amenities) {
            $data['amenities'] = json_encode($request->amenities);
        }

        if($request->amenities_prices) {
          $data['amenities_prices'] = json_encode($request->amenities_prices);
        }

        if($request->images) {
            $images = $request->images;
            $uploaded_images = [];

            foreach($images as $key => $image) {
                $imageName = $key.time().'.'.$image->getClientOriginalExtension();  
                $image->storeAs('images', $imageName, 'public');

                $imagePath = 'images/'.$imageName;

                array_push($uploaded_images, $imagePath);
            }

            $data['images'] = json_encode($uploaded_images);
        }

        if($user->role == 1) {
            $data['is_approved'] = 1;
        }

        $user->tours()->create($data);

        return redirect()->route('dashboard.index')->with('success', 'Your tour has been successfully created.');
    }

    public function approve($id)
    {
        $tour = Tour::find($id);

        $tour->is_approved = 1;
        $tour->save();

        return redirect()->back()->with('success', 'Your tour has been successfully approved.');
    }

    public function destroy($id)
    {
        $user = Auth::user();

        $tour = Tour::where('id', $id)->firstOrFail()->delete();

        return redirect()->route('dashboard.index')->with('success', 'Your tour has been successfully deleted.');
    }
}
