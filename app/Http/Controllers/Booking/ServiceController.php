<?php

namespace App\Http\Controllers\Booking;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use App\Models\Message;
use App\Models\Email;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $services = Service::all();
        
        $viewBlade = $request->query('viewBlade');
        switch ($viewBlade) {
            case 'serviceIndexTable':
                return view('services.service-component', [
                    'services' => $services,
                ]);
            default:
                return view('services.service-index', [
                    'services' => $services,
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
            'name' => 'required|string|max:255|unique:services,name', 
            'service_icon' => 'required|string|max:255', 
            'narration' => 'required|string|max:2225',
            'status' => 'nullable|in:active,inactive',
        ]);
        
        if (!Service::create($validatedData)) {
            return response()->json([
                'success' => false,
                'message' => __('Something Went Wron'),
            ]);
        } else {
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('Service created Successfully'),
                'component' => 'serviceIndexTable',
                'redirect' => route('service.index'),
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
            'service_icon' => 'required|string|max:255', 
            'narration' => 'required|string|max:2225',
            'status' => 'nullable|in:active,inactive',
        ]);
        
        $room = Service::find($id);
        
        if (!$room->update($validatedData)) {
            return response()->json([
                'success' => false,
                'message' => __('Something Went Wron'),
            ]);
        } else {
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('Service updated Successfully'),
                'component' => 'serviceIndexTable',
                'redirect' => route('service.index'),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        
        $service = Service::find($id);
        $service->delete();
        return response()->json([
            'success' => true,
            'reload' => true,
            'message' => __('Service Deleted Successfully'),
            'component' => 'serviceIndexTable',
            'redirect' => route('service.index'),
        ]);
    }

    public function storeMessage(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255', 
            'email' => 'required|string|max:255', 
            'subject' => 'required|string|max:255', 
            'message' => 'required|string|max:2225',
        ]);

        if (!Message::create($validatedData)) {
            // Flash error message to session
            return back()->with('status', __('Something Went Wrong, Try again!'));
        } else {
            // Flash success message to session
            return back()->with('status', __('Message Received Successfully!'));
        }

    }

    public function subscribe(Request $request)
    {
        $validatedData = $request->validate([
            'email' => 'required|email|unique:emails,email', // Validate email
        ]);

        if (!Email::create($validatedData)) {
            // Flash error message to session
            return back()->with('status', __('Something Went Wrong, Try again!'));
        } else {
            // Flash success message to session
            return back()->with('status', __('Thank you for subscribing!'));
        } 
    }

    public function messages(Request $request)
    {
        $messages = Message::all();
        return view('services.messages', [
            'messages' => $messages,
        ]);
    }

    public function destroyMessage($id)
    {
        $message = Message::findOrFail($id);
        if ($message) {
            $message->delete();
            return redirect()->back()->with('status', 'Message Deleted succesfully');
        }
    }
}
