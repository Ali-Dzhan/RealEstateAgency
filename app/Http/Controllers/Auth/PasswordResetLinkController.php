<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;

class PasswordResetLinkController extends Controller
{
    /**
     * Display the password reset link request view.
     */
    public function create(): View
    {
        return view('auth.forgot-password');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'username' => 'required|string',
        ]);

        // Find the user by username
        $user = User::where('username', $request->username)->first();

        if (! $user) {
            return back()->withErrors(['username' => 'No user found with that username.']);
        }

        // Create password reset token manually
        $status = Password::sendResetLink(
            ['email' => $user->email ?? 'no-reply@example.com'] // Dummy email
        );

        return $status === Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withErrors(['username' => __($status)]);
    }
}
