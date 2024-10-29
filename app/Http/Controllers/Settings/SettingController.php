<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $app_info = Setting::find(1);

        $viewBlade = $request->query('viewBlade');
        switch ($viewBlade) {
            case 'updateAppInfoForm':
                return view('settings.partials.app-information', [
                    'app_info' => $app_info,
                ]);
            case 'updateSMTPForm':
                return view('settings.partials.smtp-setting', [
                    'app_info' => $app_info,
                ]);
            case 'updateMetaInfoForm':
                return view('settings.partials.meta-setting', [
                    'app_info' => $app_info,
                ]);
            default:
                return view('settings.settings-index', [
                    'app_info' => $app_info,
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
    public function store(StoreSettingRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        if (!empty($request->input('mail_mailer'))) {
            $setting->update([
                'mail_mailer' => $request->input('mail_mailer'),
                'mail_host' => $request->input('mail_host'),
                'mail_port' => $request->input('mail_port'),
                'mail_username' => $request->input('mail_username'),
                'mail_password' => $request->input('mail_password'),
                'mail_encryption' => $request->input('mail_encryption'),
                'mail_address' => $request->input('mail_address'),
                'mail_name' => $request->input('mail_name'),
                'mail_status' => $request->input('mail_status'),
            ]);

            $componentToReload = 'updateSMTPForm';

        } else if (!empty($request->input('app_name'))) {
            $setting->update([
                'app_name' => $request->input('app_name'),
                'app_email' => $request->input('app_email'),
                'app_contact' => $request->input('app_contact'),
            ]);

            $componentToReload = 'updateAppInfoForm';

        } else if (!empty($request->input('meta_keyword'))) {
            $setting->update([
                'meta_keyword' => $request->input('meta_keyword'),
                'meta_descrip' => $request->input('meta_descrip'),
            ]);

            $componentToReload = 'updateMetaInfoForm';

        } else {
            return response()->json([
                'success' => false,
                'message' => __('auth.smthin_wrong'),
            ]);
        }

        return response()->json([
            'success' => true,
            'message' => __('roles._successful'),
            'reload' => true,
            'component' => $componentToReload,
            'redirect' => route('setting.index'),
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }

    public function uploadLogo(Request $request) 
    {
        // Validate the request
        $request->validate([
            'logo_image' => 'required|image|mimes:jpeg,png,gif|max:5120', // Max size: 5MB
        ]);

        // Handle the uploaded file
        if ($request->hasFile('logo_image')) {
            // Get the uploaded file
            $file = $request->file('logo_image');
            $path = public_path('app/assets/img/logo'); // Adjust the path as needed
            // Create the directory if it doesn't exist
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            // Check if there's an existing logo
            $setting = Setting::find(1);
            $existingLogo = $setting->logo ?? null;

            // Delete the existing logo if it exists
            if ($existingLogo && file_exists($path . '/' . $existingLogo)) {
                unlink($path . '/' . $existingLogo);
            }

            // Generate a unique filename
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();

            // Move the uploaded file to the desired location
            $file->move($path, $filename);

            // Optionally, you can store the filename in the database if needed
            $setting->update(['logo' => $filename]);

            // Return a success response
            return response()->json([
                'success' => true,
                'message' => __('roles._logo_uploaded'), 
            ]);
        }

        // Return an error response if no file was uploaded
        return response()->json([
            'success' => false,
            'message' => __('auth.no_file_uploaded'),  // Error message
        ], 400);
    }

    public function uploadFavicon(Request $request) 
    {
        try {
            // Handle the uploaded file
            if ($request->hasFile('favicon_image')) {
                // Get the uploaded file
                $file = $request->file('favicon_image');
                $path = public_path('app/assets/img/favicon'); // Adjust the path as needed
                
                // Create the directory if it doesn't exist
                if (!file_exists($path)) {
                    mkdir($path, 0755, true);
                }
        
                // Check if there's an existing favicon
                $setting = Setting::find(1);
                $existingFavicon = $setting->favicon ?? null;
        
                // Delete the existing favicon if it exists
                if ($existingFavicon && file_exists($path . '/' . $existingFavicon)) {
                    unlink($path . '/' . $existingFavicon);
                }
        
                // Generate a unique filename
                $filename = 'favicon_' . time() . '.ico'; // Always use .ico extension
        
                // Move the uploaded file to the desired location
                $file->move($path, $filename);
        
                // Optionally, you can store the filename in the database if needed
                $setting->update(['favicon' => $filename]);
        
                // Return a success response
                return response()->json([
                    'success' => true,
                    'message' => __('roles._favicon_uploaded'), 
                ]);
            }
        
            // Return an error response if no file was uploaded
            return response()->json([
                'success' => false,
                'message' => __('auth.no_file_uploaded'),  // Error message
            ], 400);
        } catch (\Exception $e) {
            \Log::error('Upload Favicon Error: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    

}
