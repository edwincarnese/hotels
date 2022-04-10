<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Tour;

class HomeController extends Controller
{
    public function index()
    {
        $units = Unit::where('is_approved', 1)->latest()->get();
        $tours = Tour::where('is_approved', 1)->latest()->get();

        return view('home', compact('units', 'tours'));
    }
}
