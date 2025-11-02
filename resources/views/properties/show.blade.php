@extends('layouts.app')

@section('content')
    <section class="py-12 px-6 md:px-12 max-w-7xl mx-auto space-y-10">

        <!-- Property Overview with Gallery and Booking -->
        <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-0">

                <!-- Left: Property Images -->
                <div class="relative">
                    @forelse($property->photos as $photo)
                        <img src="{{ asset($photo->path) }}"
                             alt="Property photo"
                             class="w-full h-[30rem] object-cover">
                    @empty
                        <img src="{{ asset('images/default.png') }}"
                             alt="Property"
                             class="w-full h-[30rem] object-cover">
                    @endforelse
                </div>

                <!-- Right: Schedule Viewing Form -->
                <div class="bg-gray-50 p-8 flex flex-col justify-center">
                    <h2 class="text-2xl font-semibold mb-6 text-gray-800 text-center">📅 Schedule a Viewing</h2>

                    @php
                        $isClient = auth()->check() && auth()->user()->role === 'client';
                        $isAvailable = $property->status === 'available';
                    @endphp

                    <form action="{{ route('viewings.store') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="property_id" value="{{ $property->id }}">

                        <div>
                            <label for="scheduled_on" class="block text-gray-700 font-medium mb-2">
                                Select Date & Time
                            </label>
                            <input type="datetime-local" name="scheduled_on" id="scheduled_on"
                                   class="w-full border rounded-lg p-3 focus:ring-2 focus:ring-blue-400 focus:outline-none"
                                   required
                                   @unless($isClient) disabled @endunless>
                            @error('scheduled_on')
                            <p class="text-red-600 text-sm mt-1 font-extrabold">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                                class="w-full py-3 rounded-lg font-semibold transition
                            {{ $isClient && $isAvailable ? 'bg-blue-600 text-white hover:bg-blue-700' : 'bg-gray-300 text-gray-500 cursor-not-allowed' }}"
                            {{ $isClient && $isAvailable ? '' : 'disabled' }}>
                            Book Viewing
                        </button>

                        @if(!$isAvailable)
                            <p class="text-red-600 text-center mt-2 text-sm font-extrabold">
                                This property is not available for viewing.
                            </p>
                        @endif

                        @unless($isClient)
                            <p class="text-gray-500 text-center mt-2 text-sm italic">
                                Only clients can schedule a viewing.
                            </p>
                        @endunless

                        @if (session('success') && $isClient)
                            <p class="text-green-600 text-center mt-2 font-extrabold">{{ session('success') }}</p>
                        @endif
                    </form>
                </div>
            </div>

            <!-- Property Details and Agent Info -->
            <div class="p-8 md:flex md:justify-between md:items-start gap-8 border-t border-gray-100">

                <!-- Left: Property Info -->
                <div class="md:flex-1">
                    <h1 class="text-4xl font-bold text-gray-800 mb-3">{{ $property->address }}</h1>
                    <p class="text-2xl font-semibold text-blue-600 mb-6">{{ number_format($property->price, 0) }} €</p>

                    <div class="grid grid-cols-2 gap-y-3 text-gray-700 mb-6">
                        <p><strong>Type:</strong> {{ $property->type->name }}</p>
                        <p><strong>Region:</strong> {{ $property->region->name }}</p>
                        <p><strong>Rooms:</strong> {{ $property->rooms ?? 'N/A' }}</p>
                        <p><strong>Area:</strong> {{ $property->area }} m²</p>
                        <p>
                            <strong>Status:</strong>
                            <span class="{{ $property->status === 'available'
                            ? 'bg-green-600/40 text-green-900 font-extrabold px-2 py-1 rounded'
                            : 'bg-red-600/40 text-red-900 font-extrabold px-2 py-1 rounded' }}">
                            {{ ucfirst($property->status) }}
                           </span>
                        </p>
                    </div>

                    <div>
                        <h2 class="text-xl font-semibold mb-2">Description</h2>
                        <p class="text-gray-700 leading-relaxed">
                            {{ $property->description ?? 'No description available for this property.' }}
                        </p>
                    </div>
                </div>

                <!-- Right: Agent Info -->
                <div class="md:w-80 bg-gray-50 rounded-xl p-6 shadow-inner">
                    <h2 class="text-xl font-semibold mb-4 border-b pb-2">Agent Information</h2>
                    <div class="space-y-2 text-gray-700">
                        <p><strong>Name:</strong> {{ $property->agent->first_name }} {{ $property->agent->last_name }}
                        </p>
                        <p><strong>Email:</strong> {{ $property->agent->email ?? 'N/A' }}</p>
                        <p><strong>Phone:</strong> {{ $property->agent->phone ?? 'N/A' }}</p>
                    </div>

                    @auth
                        @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'agent' && $property->agent_id === auth()->user()->agent->id))
                            <div class="mt-6 space-y-3">
                                <a href="{{ route('properties.edit', $property->id) }}"
                                   class="block w-full text-center bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-lg transition">
                                    Edit Property
                                </a>

                                <form action="{{ route('properties.destroy', $property->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                            onclick="return confirm('Are you sure you want to delete this property?')"
                                            class="w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3 rounded-lg transition">
                                        Delete Property
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth
                </div>
            </div>
        </div>
    </section>
@endsection
