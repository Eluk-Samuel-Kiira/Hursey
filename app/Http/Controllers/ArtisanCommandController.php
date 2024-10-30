<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;

class ArtisanCommandController extends Controller
{
    
    public function index()
    {
        return view('artisan.commands');
    }

    public function run(Request $request)
    {
        $command = $request->input('command');

        try {
            // Execute the Artisan command
            Artisan::call($command);
            $output = Artisan::output();

            return redirect()->route('artisan.index')->with([
                'status' => ucfirst($command) . ' executed successfully!',
                'output' => $output,
            ]);
        } catch (\Exception $e) {
            // Handle any errors and display a user-friendly message
            return redirect()->route('artisan.index')->with([
                'status' => 'Command execution failed: ' . $e->getMessage(),
            ]);
        }
    }


}
