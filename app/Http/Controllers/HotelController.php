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
        $name = $request->name;
        $min_price = $request->min_price;
        $max_price = $request->max_price;

        $units = Unit::query()
            ->with('user')
            ->withCount([
            'reviews AS review' => function ($query) {
                $query->select(DB::raw("(SUM(rate) / COUNT(id)) as review"));
                }
            ])
            ->when($name, function($q) use($name) {
                $q->where('name', 'LIKE', '%'.$name.'%');
            })
            ->when($min_price && $max_price, function($q) use($min_price, $max_price) {
                $q->whereBetween('price', [(int)$min_price, (int)$max_price]);
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
