<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Unit;
use App\Models\Tour;
use App\Models\Booking;
use App\Models\Room;
use Auth;

class DashboardController extends Controller
{
    // public function index()
    // {
    //     $user = Auth::user();
    //     $tours = Tour::latest()->get();
    //     $bookings = Booking::with('unit')->where('user_id', $user->id)->orWhere('owner_id', $user->id)->latest()->get();

    //     if($user->role == 1) {
    //         $units = Unit::where('user_id', $user->id)->latest()->get();
    //     }

    //       elseif($user->role == 3) {
            
    //         $units = Unit::where('user_id', $user->id)->latest()->get();
       
    //     }
    //     else
    //     {
          
    //         $units = Unit::where('is_approved', 0)->latest()->get();       
           
    //     }

    //     return view('pages.dashboard.index', compact('units', 'tours', 'bookings'));
    // }

    public function index()
    {
        $user = Auth::user();
        $tours = Tour::latest()->get();
        $rooms = Room::all(); 
        $bookings = Booking::with('unit')->where('user_id', $user->id)->orWhere('owner_id', $user->id)->latest()->get();

        if($user->role == 1 or $user->role == 2 or $user->role == 3) {
            $units = Unit::all();
        }
        //   elseif($user->role == 3) {            
        //     $units = Unit::where('user_id', $user->id)->latest()->get();       
        // }
        else
        {          
            $units = Unit::where('is_approved', 0)->latest()->get();                  
        }

        return view('pages.dashboard.index', compact('units', 'tours', 'bookings','rooms'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();

        if($request->photo) {
            $photo = time().'.'.$request->photo->getClientOriginalExtension();  
            $request->photo->storeAs('photo', $photo, 'public');

            $data['photo'] = 'photo/'.$photo;
        }

        if($request->facilities) {
            $data['facilities'] = json_encode($request->facilities);
        }

        $user->update($data);

        return redirect()->back()->with('success', 'Your profile has been successfully updated');
    }

    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        if(!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->with('error','Your current password is incorrect.');
        }

        if($request->new_password != $request->new_confirm_password) {
            return redirect()->back()->with('error','Your passwords do not match.');
        }
   
        $user->update(['password'=> Hash::make($request->new_password)]);

        return redirect()->back()->with('success', 'Your password has been successfully updated.');
    }
}
