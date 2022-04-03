<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class HotelController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $units = Unit::query()
            ->with('user')
            ->when($search, function($q) use($search) {
                $q->where('name', 'LIKE', '%'.$search.'%');
            })
            ->latest()
            ->get();

        return view('pages.hotels', compact('units'));
    }

    public function show($id)
    {
        $unit = Unit::query()
            ->with('user')
            ->where('id', $id)
            ->firstOrFail();

        return view('pages.hotels-unit', compact('unit'));
    }
}
