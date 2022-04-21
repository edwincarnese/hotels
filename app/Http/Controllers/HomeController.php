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

            
        $units = Unit::where('is_approved', 1)->latest()->get();
        // $tours = Tour::where('is_approved', 1)->latest()->get();

        return view('home', compact('units', 'tours'));
    }
}
