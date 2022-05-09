<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\Unit;
use App\Models\Tour;
use App\Models\Booking;
use App\Models\Room;
use App\Models\Transaction;
use App\Models\User;
use Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $tours = Tour::latest()->get();
        $rooms = Room::all(); 
        $bookings = Booking::with('unit')->with('tour')->where('user_id', $user->id)->orWhere('owner_id', $user->id)->latest()->get();

        $users_approval = User::where('role', 2)->where('is_approved', 0)->get();

        $transactions = Transaction::with('unit')->with('tour')->with('user')->get();

        if($user->role == 1) {
            $units = Unit::all();
        } else {
            $units = Unit::where('user_id', $user->id)->latest()->get();
        }

        return view('pages.dashboard.index', compact('units', 'tours', 'bookings','rooms', 'transactions', 'users_approval'));
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

        if($request->valid_id) {
            $valid_id = time().'.'.$request->valid_id->getClientOriginalExtension();  
            $request->valid_id->storeAs('valid_id', $valid_id, 'public');

            $data['valid_id'] = 'valid_id/'.$valid_id;
        }

        if($request->business_permit) {
            $business_permit = time().'.'.$request->business_permit->getClientOriginalExtension();  
            $request->business_permit->storeAs('business_permit', $business_permit, 'public');

            $data['business_permit'] = 'business_permit/'.$business_permit;
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

    public function userDelete($id)
    {
        User::find($id)->delete();

        return redirect()->back()->with('success', 'User approval has been successfully deleted.');
    }

    public function userApprove($id)
    {
        $user = User::find($id);

        $user->is_approved = 1;
        $user->save();

        return redirect()->back()->with('success', 'User has been successfully approved.');
    }
}
