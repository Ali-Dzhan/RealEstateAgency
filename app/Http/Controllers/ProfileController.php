<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->username = $request->input('username', $user->username);
        if ($request->filled('email')) {
            $user->email = $request->email;
        }

        if ($user->role === 'agent') {
            $agent = $user->agent;
            $agent->first_name = $request->input('first_name', $agent->first_name);
            $agent->last_name = $request->input('last_name', $agent->last_name);
            $agent->phone = $request->input('phone', $agent->phone);
            $agent->save();
        }

        if ($user->role === 'client') {
            $client = $user->client;
            $client->phone = $request->input('phone', $client->phone);
            $client->save();
        }

        $user->save();

        return redirect()->route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
