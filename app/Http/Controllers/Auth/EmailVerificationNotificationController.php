<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): JsonResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(route('dashboard', absolute: false));
        }

        $request->user()->sendEmailVerificationNotification();

        // return back()->with('status', 'verification-link-sent');

        if ($request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => __('auth.link_sent')
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => "__('smthin_wrong')"
            ]);
        }
    }
}
