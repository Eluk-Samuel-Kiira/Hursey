<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Settings\RolesController;
use App\Http\Controllers\Settings\UserController;
use App\Http\Controllers\Settings\CurrencyController;
use App\Http\Controllers\Settings\SettingController;
use App\Http\Controllers\Booking\BookingController;
use App\Http\Controllers\Booking\ServiceController;
use App\Http\Controllers\Booking\RoomsController;
use App\Http\Controllers\ArtisanCommandController;
use Illuminate\Support\Facades\Route;




    Route::post('/contact-message', [ServiceController::class, 'storeMessage'])->name('store.message');
    Route::post('/newsletter/subscribe', [ServiceController::class, 'subscribe'])->name('newsletter.subscribe');

    //Artisan Commands for help in Cpanel
    
    Route::get('/artisan-commands', [ArtisanCommandController::class, 'index'])->name('artisan.index');
    Route::post('/artisan-commands/run', [ArtisanCommandController::class, 'run'])->name('artisan.run');
        
    Route::get('/', [BookingController::class, 'welcomePage']);

    Route::get('/dashboard', [BookingController::class, 'index'])
        ->middleware(['auth', 'verified'])->name('dashboard');

    Route::middleware('auth')->group(function () {
    // user profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile/upload-image', [ProfileController::class, 'uploadImage'])->name('profile.upload_image');


    // user roles and Permissions
    Route::resource('role', RolesController::class);
    Route::get('/user-permissions', function () {
        return view('roles.user-permission');
    })->name('user-permission');

    // user mgt
    Route::resource('user', UserController::class);

    // settings
    Route::resource('setting', SettingController::class);
    Route::post('/logo-upload', [SettingController::class, 'uploadLogo'])->name('logo.upload');
    Route::post('/favicon-upload', [SettingController::class, 'uploadFavicon'])->name('favicon.upload');
    Route::resource('currency', CurrencyController::class);

    // Booking
    Route::resource('booking', BookingController::class);
    Route::put('/update-aboutus', [BookingController::class, 'updateAboutUs'])->name('aboutus.update');
    Route::get('/gallery-upload', [BookingController::class, 'uploadIndex'])->name('upload.gallery');
    Route::post('/upload-image', [BookingController::class, 'storeImage'])->name('store.gallery');
    Route::delete('/galleries/{id}', [BookingController::class, 'destroyGallery'])->name('galleries.destroy');
    Route::post('/galleries/{id}/toggle-about-status', [BookingController::class, 'toggleAboutStatus'])->name('galleries.toggleAboutStatus');


    // Rooms
    Route::resource('room', RoomsController::class);
    Route::resource('service', ServiceController::class);
    Route::get('/message-index', [ServiceController::class, 'messages'])->name('message.index');
    Route::delete('/message/{id}', [ServiceController::class, 'destroyMessage'])->name('message.destroy');

});

require __DIR__.'/auth.php';
