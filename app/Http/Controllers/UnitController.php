<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Tour;
use Auth;

class UnitController extends Controller
{
    public function create(Request $request)
    {
        $tour_id = $request->tour;
      
        $tours = Tour::query()
            ->where('is_approved', 1)
            ->orderBy('title', 'ASC')
            ->where('is_approved', 1)
            ->get();

        return view('pages.dashboard.units.create', compact('tours','tour_id'));
    }
    // public function tourUnitCreate()
    // {
    //     $tours = Tour::query()
    //         ->where('is_approved', 1)
    //         ->orderBy('title', 'ASC')
    //         ->where('is_approved', 1)
    //         ->get();

    //     return view('pages.dashboard.units.create', compact('tours'));
    // }
    
    public function edit($id)
    {
        $unit = Unit::find($id);

        $tours = Tour::query()
            ->where('is_approved', 1)
            ->orderBy('title', 'ASC')
            ->where('is_approved', 1)
            ->get();
        
        return view('pages.dashboard.units.edit', compact('unit', 'tours'));
    }

    public function update(Request $request)
    {
        $unit = Unit::find($request->id);
        
        $data = $request->all();

        if($request->facilities) {
            $data['facilities'] = json_encode($request->facilities);
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

        $unit->update($data);

        return redirect()->route('dashboard.index')->with('success', 'Your property has been successfully updated.');

    }

    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();

        if($request->facilities) {
            $data['facilities'] = json_encode($request->facilities);
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

        $user->units()->create($data);

        return redirect()->route('dashboard.index')->with('success', 'Your property has been successfully created.');
    }

    public function destroy($id)
    {
        $user = Auth::user();

        $unit = Unit::where('id', $id)->firstOrFail()->delete();

        return redirect()->route('dashboard.index')->with('success', 'Your unit has been successfully deleted.');
    }

    public function approve($id)
    {
        $unit = Unit::find($id);

        $unit->is_approved = 1;
        $unit->save();

        return redirect()->route('dashboard.index')->with('success', 'Your unit has been successfully approved.');
    }
}
