<?php

namespace App\Http\Controllers;

use App\Models\Testimony;
use Illuminate\Http\Request;

class TestimonyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $testimonies = Testimony::where('status', 'active')->latest()->take(20)->get();

        return view('welcome.testimony.testimony', [
            'testimonies' => $testimonies,
        ]);
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
            'name' => 'required|string|max:255', 
            'testimony' => 'required|string|max:2225',
        ]);

        if (!Testimony::create($validatedData)) {
            // Flash error message to session
            return back()->with('status', __('Something Went Wrong, Try again!'));
        } else {
            // Flash success message to session
            return back()->with('status', __('Testimony Received Successfully!'));
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Testimony $testimony)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Testimony $testimony)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Testimony $testimony)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Testimony $testimony)
    {
        if ($testimony) {
            $testimony->delete();
            return redirect()->back()->with('status', 'Testimony Deleted succesfully');
        }
    }
}
