<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Booking;
use App\Models\About;
use App\Models\Room;
use Carbon\Carbon;
use App\Models\Gallery;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Service;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $bookings = Booking::all();
        
        $viewBlade = $request->query('viewBlade');
        switch ($viewBlade) {
            case 'bookingIndexTable':
                return view('bookings.booking-component', [
                    'bookings' => $bookings,
                ]);
            default:
                return view('bookings.booking-index', [
                    'bookings' => $bookings,
                ]);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $about_us = About::find(1);

        $viewBlade = $request->query('viewBlade');
        switch ($viewBlade) {
            case 'updateAboutUsInfoForm':
                return view('bookings.about.about-component', [
                    'about_us' => $about_us,
                ]);
            default:
                return view('bookings.about.about-us-index', [
                    'about_us' => $about_us,
                ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_number' => 'required|string|max:20',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guest_number' => 'required|integer|min:1',
            'coming_from' => 'required|string|max:255',
            'special_requests' => 'nullable|string',
            'status' => 'nullable|in:reserved,checked_in,checked_out,canceled',
            'txn_status' => 'nullable|in:pending,completed,failed',
        ]);

        $validatedData['check_in'] = Carbon::parse($request->input('check_in'))->format('Y-m-d');
        $validatedData['check_out'] = Carbon::parse($request->input('check_out'))->format('Y-m-d');

        // Add the IP address to the validated data
        $validatedData['ip_address'] = $request->ip();
        if (!Booking::create($validatedData)) {
            return response()->json([
                'success' => false,
                'message' => __('Something Went Wrong, Try again!'),
            ]);
        } else {
            return response()->json([
                'success' => true,
                'message' => __('Reservation Received Successfully!'),
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
            'customer_name' => 'required|string|max:255',
            'customer_number' => 'required|string|max:20',
            'check_in' => 'required|date|after_or_equal:today',
            'check_out' => 'required|date|after:check_in',
            'guest_number' => 'required|integer|min:1',
            'coming_from' => 'required|string|max:255',
            'special_requests' => 'nullable|string',
            'status' => 'nullable|in:reserved,checked_in,checked_out,canceled',
            'txn_status' => 'nullable|in:pending,completed,failed',
            'booking_id' => 'nullable|integer',
        ]);

        $validatedData['check_in'] = Carbon::parse($request->input('check_in'))->format('Y-m-d');
        $validatedData['check_out'] = Carbon::parse($request->input('check_out'))->format('Y-m-d');

        $booking = Booking::find($validatedData['booking_id']);

        if(!$booking->update($validatedData)) {
            return response()->json([
                'success' => false,
                'message' => __('Something Went Wrong!'),
            ]);
        } else {
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('Customer Reservation updated Successfully'),
                'component' => 'bookingIndexTable',
                'redirect' => route('booking.index'),
            ]);
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $booking = Booking::find($id);
        if ($booking->status === 'reserved') {
            return response()->json([
                'success' => false,
                'message' => __('Reservation cannot be deleted, customer not serviced yet'),
            ]);
        } else {
            $booking->delete();
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('Customer Reservation deleted Successfully'),
                'component' => 'bookingIndexTable',
                'redirect' => route('booking.index'),
            ]);
        }
    }

    public function updateAboutUs(Request $request) 
    {
        // \Log::info($request);
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'no_clients' => 'required|integer',
            'no_room' => 'required|integer',
            'no_staff' => 'required|integer',
            'about_text' => 'required|string|min:1',
        ]);

        $about_us = About::find(1);

        if ($about_us->update($validatedData)) {
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('About Us Info Updated Successfully'),
                'component' => 'updateAboutUsInfoForm',
                'redirect' => route('booking.create'),
            ]);
        }
    }

    public function welcomePage() 
    {
        $about_photo = Gallery::where('about_status', 'active')->latest()->take(4)->get();
        $rooms = Room::latest()->get();
        $services = Service::latest()->where('status', 'active')->get();
        $about_us = About::find(1);
        return view('welcome.home', [
            'about_us' => $about_us,
            'about_photo' => $about_photo,
            'rooms' => $rooms,
            'services' => $services,
        ]);
    }

    public function uploadIndex(Request $request) 
    {
        $galleries = Gallery::latest()->get();
        $viewBlade = $request->query('viewBlade');

        return view('gallery.gallery-index', [
            'galleries' => $galleries,
        ]);
    }

    public function storeImage(Request $request) 
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max size if needed
        ]);
    
        // Store the uploaded image in the 'public/images' directory
        $imagePath = $request->file('image')->store('images', 'public');
    
        // Save name and image path to the database
        $gallery = new Gallery();
        $gallery->name = $validatedData['name'] . '_' . Str::random(5);
        $gallery->image = $imagePath;
        $gallery->save();

        return response()->json([
            'success' => true,
            'reload' => true,
            'message' => __('Image Saved to gallery successfully'),
        ]);
    }

    public function dashboardIndex()
    {
        return view('dashboard.dashboard');
    }


    public function destroyGallery($id)
    {
        $gallery = Gallery::findOrFail($id);

        $imagePath = $gallery->image;
        if (Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }
        $gallery->delete();

        return redirect()->back()->with('message', 'Image removed successfully!');
    }

    public function toggleAboutStatus($id)
    {
        $gallery = Gallery::findOrFail($id);

        // Toggle the status
        $gallery->about_status = $gallery->about_status === 'active' ? 'inactive' : 'active';
        $gallery->save();

        return redirect()->back()->with('message', 'About page status updated successfully!');
    }


}
