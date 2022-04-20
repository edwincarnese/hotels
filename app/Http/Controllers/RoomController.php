<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Unit;
use App\Models\Tour;
use App\Models\Room;
use App\Models\Review;
use Auth;

class RoomController extends Controller
{
   


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */    
    public function create(Request $request)
    {
        $tour_id = $request->tour;
        // dd($tour_id);
      
        $tours = Tour::query()
            ->where('is_approved', 1)
            ->orderBy('title', 'ASC')
            ->where('is_approved', 1)
            ->get();
        return view('pages.dashboard.rooms.create', compact('tours','tour_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
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

        $user->rooms()->create($data);

        return redirect()->route('dashboard.index')->with('success', 'Your Rooms has been successfully created.');
   
    }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
       
        $room = Room::query()
            ->with('user')
            ->where('id', $id)
            ->where('is_approved', 1)
            ->firstOrFail();
           
        $rooms = Room::query()
            ->with('user')
            ->where('id', $id)
            ->where('is_approved', 1)->get();

        $tour_id = '';
        $room_id = $room->id;
      
        $reviews = Review::with('user')->where('tour_id', $room_id)->latest()->get();
        // return view('pages.hotels-room', compact('unit', 'units', 'tour_id', 'unit_id', 'reviews'));
        return view('pages.hotels-room', compact('room', 'rooms','tour_id', 'room_id','reviews'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $unit = Unit::find($id);
        $rooms = Room::find($id);

        $tours = Tour::query()
            ->where('is_approved', 1)
            ->orderBy('title', 'ASC')
            ->where('is_approved', 1)
            ->get();
        
        return view('pages.dashboard.rooms.edit', compact('unit', 'tours','rooms'));
    }


    

    public function update(Request $request)
    {
        $room = Room::find($request->id);
        
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

        $room->update($data);

        return redirect()->route('dashboard.index')->with('success', 'Your property has been successfully updated.');

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function destroy($id)
    {
        $user = Auth::user();

        $room = Room::where('id', $id)->where('user_id', $user->id)->firstOrFail()->delete();

        return redirect()->route('dashboard.index')->with('success', 'Your unit has been successfully deleted.');
    }
}
