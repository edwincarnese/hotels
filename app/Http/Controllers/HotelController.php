<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Review;
use DB;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $units = Unit::query()
            ->with('user')
            ->withCount([
            'reviews AS review' => function ($query) {
                $query->select(DB::raw("(SUM(rate) / COUNT(id)) as review"));
                }
            ])
            ->when($search, function($q) use($search) {
                $q->where('name', 'LIKE', '%'.$search.'%');
            })
            ->where('is_approved', 1)
            ->latest()
            ->get();

        return view('pages.hotels', compact('units'));
    }

    public function show($id)
    {
        $unit = Unit::query()
            ->with('user')
            ->where('id', $id)
            ->where('is_approved', 1)
            ->firstOrFail();

        $units = Unit::query()
            ->with('user')
            ->where('id', $id)
            ->where('is_approved', 1)->get();

        $tour_id = '';
        $unit_id = $unit->id;

        $reviews = Review::with('user')->where('unit_id', $unit_id)->latest()->get();

        return view('pages.hotels-unit', compact('unit', 'units', 'tour_id', 'unit_id', 'reviews'));
    }
}
