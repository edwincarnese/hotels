<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;
use Auth;

class UnitController extends Controller
{
    public function index()
    {
        return view('pages.dashboard.units.index');
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

        $user->units()->create($data);

        return redirect()->back()->with('success', 'Your property has been successfully created.');
    }

    public function destroy($id)
    {
        $user = Auth::user();

        $unit = Unit::where('id', $id)->where('user_id', $user->id)->firstOrFail()->delete();

        return redirect()->back()->with('success', 'Your unit has been successfully deleted.');
    }
}
