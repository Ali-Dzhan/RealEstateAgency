@extends('layouts.app')

@section('content')
    <section class="py-16 px-6 md:px-12">
        <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-lg p-8">
            <h1 class="text-3xl font-bold text-center mb-8">Edit Agent</h1>

            {{-- Validation errors --}}
            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
                    <ul class="list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('agents.update', $agent->id) }}" method="POST" class="space-y-6">
                @csrf
                @method('PUT')

                <div>
                    <label for="first_name" class="block text-gray-700 font-semibold mb-2">First Name</label>
                    <input type="text" name="first_name" id="first_name"
                           value="{{ old('first_name', $agent->first_name) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="last_name" class="block text-gray-700 font-semibold mb-2">Last Name</label>
                    <input type="text" name="last_name" id="last_name"
                           value="{{ old('last_name', $agent->last_name) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" name="email" id="email"
                           value="{{ old('email', $agent->email) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="phone" class="block text-gray-700 font-semibold mb-2">Phone</label>
                    <input type="text" name="phone" id="phone"
                           value="{{ old('phone', $agent->phone) }}"
                           class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label for="role" class="block text-gray-700 font-semibold mb-2">Role</label>
                    <select name="role" id="role"
                            class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="admin" {{ $agent->user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="agent" {{ $agent->user->role === 'agent' ? 'selected' : '' }}>Agent</option>
                        <option value="client" {{ $agent->user->role === 'client' ? 'selected' : '' }}>Client</option>
                    </select>
                </div>

                <div class="flex justify-between mt-8">
                    <a href="{{ route('agents.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600 transition">
                        Cancel
                    </a>
                    <button type="submit"
                            class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700 transition">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
