<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Auth;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        $review = new Review();
        $review->unit_id = $request->unit_id;
        $review->tour_id = $request->tour_id;
        $review->user_id = $user->id;
        $review->rate = $request->rate;
        $review->message = $request->message;
        $review->save();

        return redirect()->back()->with('success', 'Your review has been successfully saved.');
    }
}
