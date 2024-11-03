<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Gallery;

class RoomsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $galleries = Gallery::latest()->get();
        $rooms = Room::latest()->get();
        
        
        $viewBlade = $request->query('viewBlade');
        switch ($viewBlade) {
            case 'roomIndexTable':
                return view('rooms.rooms-component', [
                    'galleries' => $galleries,
                    'rooms' => $rooms,
                ]);
            default:
                return view('rooms.rooms-index', [
                    'galleries' => $galleries,
                    'rooms' => $rooms,
                ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $validatedData = $request->validate([
            'name' => 'required|string|max:255|unique:rooms,name',            
            'price' => 'required|integer',
            'bath' => 'required|integer|max:255',
            'image_id' => 'required|integer|max:255',
            'bed' => 'required|integer|max:20',
            'narration' => 'required|string|max:2225',
            'status' => 'nullable|in:reserved,checked_in,checked_out,canceled',
        ]);
        
        
        if (!Room::create($validatedData)) {
            return response()->json([
                'success' => false,
                'message' => __('Something Went Wron'),
            ]);
        } else {
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('Room created Successfully'),
                'component' => 'roomIndexTable',
                'redirect' => route('room.index'),
            ]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',            
            'price' => 'required|integer',
            'bath' => 'required|integer|max:255',
            'image_id' => 'required|integer|max:255',
            'bed' => 'required|integer|max:20',
            'narration' => 'required|string|max:2225',
            'status' => 'nullable|in:reserved,checked_in,checked_out,canceled',
        ]);

        
        $room = Room::find($id);
        
        if (!$room->update($validatedData)) {
            return response()->json([
                'success' => false,
                'message' => __('Something Went Wrong'),
            ]);
        } else {
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('Room updated Successfully'),
                'component' => 'roomIndexTable',
                'redirect' => route('room.index'),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $room = Room::find($id);
        if ($room->status === 'reserved') {
            return response()->json([
                'success' => false,
                'message' => __('Room Has Been reserved, free it and then delete'),
            ]);
        } else {
            $room->delete();
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('Room deleted Successfully'),
                'component' => 'roomIndexTable',
                'redirect' => route('room.index'),
            ]);
        }
    }
}
