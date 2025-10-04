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
     * Show the registration form
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle registration
     */
    public function store(Request $request): RedirectResponse
    {
        // Base rules
        $rules = [
            'username' => ['required', 'string', 'max:255', 'unique:users,username'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role'     => ['required', 'in:agent,client'],
        ];

        // Role-specific rules
        if ($request->role === 'agent') {
            $rules = array_merge($rules, [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name'  => ['required', 'string', 'max:255'],
                'email'      => ['nullable', 'email', 'unique:agents,email'],
                'phone'      => ['nullable', 'string'],
            ]);
        }

        if ($request->role === 'client') {
            $rules = array_merge($rules, [
                'name'  => ['required', 'string', 'max:255'],
                'email' => ['nullable', 'email', 'unique:clients,email'],
                'phone' => ['nullable', 'string'],
            ]);
        }

        // Validate
        $validated = $request->validate($rules);

        // Create user
        $user = User::create([
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role'     => $validated['role'],
        ]);

        // Create role-specific profile
        if ($user->role === 'agent') {
            Agent::create([
                'user_id'    => $user->id,
                'first_name' => $validated['first_name'],
                'last_name'  => $validated['last_name'],
                'phone'      => $validated['phone'] ?? null,
                'email'      => $validated['email'] ?? null,
            ]);
        }

        if ($user->role === 'client') {
            Client::create([
                'user_id' => $user->id,
                'name'    => $validated['name'],
                'phone'   => $validated['phone'] ?? null,
                'email'   => $validated['email'] ?? null,
            ]);
        }

        // Fire registered event + log in user
        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('home');
    }
}
