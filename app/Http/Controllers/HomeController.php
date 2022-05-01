<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Tour;
use DB;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $tours = Tour::query()
            ->with('user')
            ->where('is_approved', 1)
            ->get();

        $featured_tours = Tour::query()
            ->with('user')
            ->withCount([
                'reviews AS review' => function ($query) {
                    $query->select(DB::raw("(SUM(rate) / COUNT(id)) as review"));
                }])
            ->where('is_approved', 1)
            ->get();

        $units = Unit::query()
            ->with('user')
            ->withCount([
                'reviews AS review' => function ($query) {
                    $query->select(DB::raw("(SUM(rate) / COUNT(id)) as review"));
                }])
            ->where('is_approved', 1)
            ->get();

        $featured_units = Unit::query()
            ->with('user')
            ->withCount([
                'reviews AS review' => function ($query) {
                    $query->select(DB::raw("(SUM(rate) / COUNT(id)) as review"));
                }])
            ->where('is_approved', 1)
            ->latest()
            ->take(6)
            ->get();
            
        return view('home', compact('units', 'tours', 'featured_units', 'featured_tours'));
    }
}
