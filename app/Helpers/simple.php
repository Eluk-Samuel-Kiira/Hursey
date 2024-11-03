<?php

use App\Models\Setting;
use App\Models\Currency;


if (! function_exists('is_collapsed_route')) {
    function is_collapsed_route($routeName)
    {
        return request()->routeIs($routeName) ? '' : 'collapsed';
    }
}


if (! function_exists('is_active_route')) {
    function is_active_route($routeName)
    {
        return request()->routeIs($routeName) ? 'active' : '';
    }
}


if (! function_exists('is_collapse_tab')) {
    function is_collapse_tab(array $routeName)
    {
        return request()->routeIs($routeName) ? '' : 'collapse';
    }
}

if (! function_exists('is_collapsed_tab')) {
    function is_collapsed_tab(array $routeNames)
    {
        return request()->routeIs($routeNames) ? '' : 'collapsed';
    }
}



if (!function_exists('getProfileImage')) {
    function getProfileImage()
    {
        $user = auth()->user();
        $defaultImage = asset('admin/assets/img/profile-img.jpg'); // Default image path

        // Check if the user exists and has a profile image
        if ($user && $user->profile_image) {
            // Use the stored relative path
            $filename = $user->profile_image;

            // Build the full path to the image using the public path
            $path = public_path('storage/' . $filename); // Full path to the file

            // Check if the file exists
            if (file_exists($path)) {
                // Return the URL to access the image
                return asset('storage/' . $filename); // Return the image URL
            }
        }

        // Return the default image URL if no profile image is found
        return $defaultImage;
    }
}


if (!function_exists('getLogoImage')) {
    function getLogoImage()
    {
        // Retrieve the logo filename from the settings table
        $setting = Setting::find(1);
        
        if ($setting && !empty($setting->logo)) {
            $logoPath = public_path('app/assets/img/logo/' . $setting->logo);
            
            // Check if the logo image exists in the specified location
            if (file_exists($logoPath)) {
                return asset('app/assets/img/logo/' . $setting->logo); // Return the logo URL from the database
            }
        }

        // Return the default logo if not found in the database or does not exist
        return asset('admin/assets/img/logo.png'); // Default logo path
    }
}


if (!function_exists('getFaviconImage')) {
    function getFaviconImage()
    {
        // Retrieve the logo filename from the settings table
        $setting = Setting::find(1);
        
        if ($setting && !empty($setting->favicon)) {
            $logoPath = public_path('app/assets/img/favicon/' . $setting->favicon);
            
            // Check if the logo image exists in the specified location
            if (file_exists($logoPath)) {
                return asset('app/assets/img/favicon/' . $setting->favicon); // Return the logo URL from the database
            }
        }
        return asset('admin/assets/img/favicon.png');
    }
}


function appDefaultCurrency()
{
    $currency = Currency::where('default', 1)->first();
    if ($currency) {
        return $currency->currency_code;
    } else {
        return 'UGX';
    }
}

function getAppName()
{
    $app = Setting::first();
    $stardena = 'Boutika';
    if (!empty($app->app_name))
        return $app->app_name;
    else
        return $stardena;
}


function getMailOptions($option_key){
    $app_details = Setting::first();
    if ($option_key && isset($app_details[$option_key])) {
        return $app_details[$option_key];
    } else {
        $default = '';
        return $default;
    }
}

