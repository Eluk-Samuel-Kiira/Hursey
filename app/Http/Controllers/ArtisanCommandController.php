<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Artisan;

class ArtisanCommandController extends Controller
{
    protected $allowedCommands = [
        'optimize:clear',
        'migrate',
        'db:seed',
        'storage:link',
        'migrate:rollback',
    ];

    public function index()
    {
        return view('artisan.commands');
    }

    public function run(Request $request)
    {
        $command = $request->input('command');

        // Check if the command is allowed
        if (!in_array($command, $this->allowedCommands)) {
            return redirect()->route('artisan.index')->with('status', 'Invalid command!');
        }

        // Add --force flag only for commands that support it
        $options = [];
        if (in_array($command, ['migrate', 'db:seed'])) {
            $options['--force'] = true;
        }

        try {
            // Capture Artisan output
            Artisan::call($command, $options);
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
