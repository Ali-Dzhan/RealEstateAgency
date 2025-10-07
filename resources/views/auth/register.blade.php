@extends('layouts.guest')

@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')"/>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Username -->
        <div>
            <x-input-label for="username" :value="__('Username')"/>
            <x-text-input id="username" class="block mt-1 w-full" type="text" name="username"
                          :value="old('username')" required autofocus/>
            <x-input-error :messages="$errors->get('username')" class="mt-2"/>
        </div>

        <!-- Role -->
        <div class="mt-4">
            <x-input-label for="role" :value="__('Role')"/>
            <select id="role" name="role"
                    class="block mt-1 w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                <option value="">-- Select role --</option>
                <option value="agent" {{ old('role') === 'agent' ? 'selected' : '' }}>Agent</option>
                <option value="client" {{ old('role') === 'client' ? 'selected' : '' }}>Client</option>
            </select>
            <x-input-error :messages="$errors->get('role')" class="mt-2"/>
        </div>

        <!-- Agent fields -->
        <div id="agent-fields" class="mt-4" style="display: none;">
            <x-input-label for="first_name" :value="__('First Name')"/>
            <x-text-input id="first_name" class="block mt-1 w-full" type="text" name="first_name"
                          :value="old('first_name')"/>
            <x-input-error :messages="$errors->get('first_name')" class="mt-2"/>

            <x-input-label for="last_name" :value="__('Last Name')" class="mt-4"/>
            <x-text-input id="last_name" class="block mt-1 w-full" type="text" name="last_name"
                          :value="old('last_name')"/>
            <x-input-error :messages="$errors->get('last_name')" class="mt-2"/>

            <x-input-label for="agent_email" :value="__('Email (optional)')" class="mt-4"/>
            <x-text-input id="agent_email" class="block mt-1 w-full" type="email" name="agent_email"
                          :value="old('agent_email')"/>
            <x-input-error :messages="$errors->get('agent_email')" class="mt-2"/>

            <x-input-label for="agent_phone" :value="__('Phone (optional)')" class="mt-4"/>
            <x-text-input id="agent_phone" class="block mt-1 w-full" type="text" name="agent_phone"
                          :value="old('agent_phone')"/>
            <x-input-error :messages="$errors->get('agent_phone')" class="mt-2"/>
        </div>

        <!-- Client fields -->
        <div id="client-fields" class="mt-4" style="display: none;">
            <x-input-label for="name" :value="__('Name')"/>
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name"
                          :value="old('name')"/>
            <x-input-error :messages="$errors->get('name')" class="mt-2"/>

            <x-input-label for="client_email" :value="__('Email (optional)')" class="mt-4"/>
            <x-text-input id="client_email" class="block mt-1 w-full" type="email" name="client_email"
                          :value="old('client_email')"/>
            <x-input-error :messages="$errors->get('client_email')" class="mt-2"/>

            <x-input-label for="client_phone" :value="__('Phone (optional)')" class="mt-4"/>
            <x-text-input id="client_phone" class="block mt-1 w-full" type="text" name="client_phone"
                          :value="old('client_phone')"/>
            <x-input-error :messages="$errors->get('client_phone')" class="mt-2"/>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')"/>
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required/>
            <x-input-error :messages="$errors->get('password')" class="mt-2"/>
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                          name="password_confirmation" required/>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
        </div>

        <!-- Buttons -->
        <div class="flex items-center justify-end mt-6">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none
                       focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
               href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-3">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

    <script>
        const roleSelect = document.getElementById('role');
        const agentFields = document.getElementById('agent-fields');
        const clientFields = document.getElementById('client-fields');

        function toggleFields() {
            agentFields.style.display = 'none';
            clientFields.style.display = 'none';

            if (roleSelect.value === 'agent') agentFields.style.display = 'block';
            if (roleSelect.value === 'client') clientFields.style.display = 'block';
        }

        roleSelect.addEventListener('change', toggleFields);

        // Show old input on page load
        const oldRole = "{{ old('role') }}";
        if (oldRole === 'agent') agentFields.style.display = 'block';
        if (oldRole === 'client') clientFields.style.display = 'block';
    </script>
@endsection
