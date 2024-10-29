<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $viewBlade = $request->query('viewBlade');
        switch ($viewBlade) {
            case 'updatePasswordForm':
                return view('profile.partials.update-password-form', ['user' => $request->user(),]);
            case 'updateProfileInfoForm':
                return view('profile.partials.update-profile-information-form', ['user' => $request->user(),]);
            default:
                return view('profile.edit', ['user' => $request->user(),]);
        }

        // return view('profile.edit', [
        //     'user' => $request->user(),
        // ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): JsonResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            
            // Generate a unique filename with a timestamp and the file's extension
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            
            // Store the image in the 'profile' folder in storage/app/public
            $path = $image->storeAs('public/images/profile', $imageName);
        
            // If you want to use a publicly accessible URL:
            $url = Storage::url($path);
            
        }
        

        // return Redirect::route('profile.edit')->with('status', 'profile-updated');
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'reload' => true,
                'message' => __('auth._profile_updated'),
                'component' => 'updateProfileInfoForm',
                'redirect' => route('profile.edit'),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "something went wrong!"
            ]);
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): JsonResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        // return Redirect::to('/');
        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'redirect' => route('login'),
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "__('smthin_wrong')"
            ]);
        }
    }


    /**
     * Upload User Image
     */
    public function uploadImage(Request $request)
    {
        // Validate the request to ensure the file exists
        $request->validate([
            'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Validation rules
        ]);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');

            // Get the currently authenticated user
            $user = auth()->user();

            // Check if the user already has a profile image and delete it
            if ($user->profile_image) {
                // Get the old image path from the user's profile
                $oldImagePath = public_path('storage/' . $user->profile_image); // Get full path to old image
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath); // Delete the old image from storage
                }
            }

            // Define the directory where the images will be stored
            $destinationPath = public_path('storage/profile_images');

            // Create the directory if it doesn't exist
            if (!is_dir($destinationPath)) {
                mkdir($destinationPath, 0755, true);
            }

            // Store the new image in the defined directory
            $fileName = time() . '.' . $image->getClientOriginalExtension();
            $image->move($destinationPath, $fileName);

            // Save the new image filename to the user's profile (not the URL)
            $user->profile_image = 'profile_images/' . $fileName; // Store relative path
            $user->save();

            // Respond with success if it's an AJAX request
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'reload' => true,
                    'message' => __('auth._profile_updated'),
                    'component' => 'updateProfileInfoForm',
                    'redirect' => route('profile.edit'),
                ]);
            }
        }

        // Return an error response if something goes wrong
        return response()->json([
            'success' => false,
            'message' => "Something went wrong!",
        ]);
    }


}
