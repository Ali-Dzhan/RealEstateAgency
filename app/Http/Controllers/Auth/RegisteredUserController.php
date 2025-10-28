<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Agent;
use App\Models\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Show the registration form.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle registration.
     */
    public function store(Request $request): RedirectResponse
    {
        // Base validation for all users
        $rules = [
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'     => ['required', 'in:agent,client'],
        ];

        // Role-specific validation
        if ($request->role === 'agent') {
            $rules = array_merge($rules, [
                'first_name'  => ['required', 'string', 'max:255'],
                'last_name'   => ['required', 'string', 'max:255'],
                'agent_email' => ['nullable', 'email', 'unique:agents,email'],
                'agent_phone' => ['nullable', 'string'],
            ]);
        } elseif ($request->role === 'client') {
            $rules = array_merge($rules, [
                'name'         => ['required', 'string', 'max:255'],
                'client_email' => ['nullable', 'email', 'unique:clients,email'],
                'client_phone' => ['nullable', 'string'],
            ]);
        }

        // Validate the request
        $validated = $request->validate($rules);

        // Determine email for users table
        $email = $validated['role'] === 'agent' ? ($validated['agent_email'] ?? null) : ($validated['client_email'] ?? null);

        // Create the user
        $user = User::create([
            'username' => $validated['username'],
            'email'    => $email,
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        // Create role-specific profile
        if ($user->role === 'agent') {
            Agent::create([
                'user_id'    => $user->id,
                'first_name' => $validated['first_name'],
                'last_name'  => $validated['last_name'],
                'email'      => $validated['agent_email'] ?? null,
                'phone'      => $validated['agent_phone'] ?? null,
            ]);
        } elseif ($user->role === 'client') {
            Client::create([
                'user_id' => $user->id,
                'name'    => $validated['name'],
                'email'   => $validated['client_email'] ?? null,
                'phone'   => $validated['client_phone'] ?? null,
            ]);
        }

        // Fire registered event and log in the user
        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('home');
    }
}
