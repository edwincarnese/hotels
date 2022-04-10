<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tour;
use App\Models\Unit;
use App\Models\User;
use App\Models\Review;
use Auth;

class TourController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->search;

        $tours = Tour::query()
            ->with('user')
            ->when($search, function($q) use($search) {
                $q->where('title', 'title', '%'.$search.'%');
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
        $tour = Tour::query()
            ->with('user')
            ->where('id', $id)
            ->where('is_approved', 1)
            ->firstOrFail();

        $units = Unit::query()
            ->with('user')
            ->where('is_approved', 1)
            ->where('tour_id', $tour->id)
            ->latest()
            ->get();

        $tour_id = $tour->id;
        $unit_id = '';
        
        $reviews = Review::with('user')->where('tour_id', $tour_id)->latest()->get();

        return view('pages.tours-hotels', compact('tour', 'units', 'tour_id', 'unit_id', 'reviews'));
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
