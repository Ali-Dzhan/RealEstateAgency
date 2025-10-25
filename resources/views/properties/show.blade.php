@extends('layouts.app')

@section('content')
    <section class="py-12 px-6 md:px-12 max-w-7xl mx-auto">

        <!-- Main Property Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
            <!-- Property Images -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:h-96">
                @if($property->photos->isNotEmpty())
                    @foreach($property->photos as $photo)
                        <img src="{{ asset($photo->path) }}"
                             alt="Property photo"
                             class="w-full h-64 md:h-full object-cover">
                    @endforeach
                @else
                    <img src="{{ asset('images/default.png') }}"
                         alt="Property"
                         class="w-full h-64 md:h-full object-cover">
                @endif
            </div>

            <form action="{{ route('viewings.store') }}" method="POST" class="max-w-md mx-auto mt-8 p-4 bg-white rounded-lg shadow">
                @csrf
                <h2 class="text-xl font-semibold mb-4">Schedule a Viewing</h2>

                <input type="hidden" name="property_id" value="{{ $property->id ?? 1 }}"> {{-- Replace with real property ID --}}

                <div class="mb-4">
                    <label for="scheduled_on" class="block text-gray-700 font-medium mb-1">Select Date & Time:</label>
                    <input type="datetime-local" name="scheduled_on" id="scheduled_on"
                           class="w-full border rounded-lg p-2" required>
                </div>

                @error('scheduled_on')
                <p class="text-red-500 text-sm mb-2">{{ $message }}</p>
                @enderror

                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    Book Viewing
                </button>

                @if (session('success'))
                    <p class="mt-3 text-green-600">{{ session('success') }}</p>
                @endif

                @if ($errors->any())
                    <ul class="mt-3 text-red-600 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
            </form>

            <!-- Property Info & Actions -->
            <div class="p-8 md:flex md:justify-between md:items-start gap-8">
                <!-- Details Column -->
                <div class="md:flex-1">
                    <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $property->address }}</h1>
                    <p class="text-2xl text-blue-600 font-semibold mb-6">{{ number_format($property->price, 0) }} €</p>

                    <div class="grid grid-cols-2 gap-4 text-gray-700 mb-6">
                        <p><strong>Type:</strong> {{ $property->type->name }}</p>
                        <p><strong>Region:</strong> {{ $property->region->name }}</p>
                        <p><strong>Rooms:</strong> {{ $property->rooms ?? 'N/A' }}</p>
                        <p><strong>Area:</strong> {{ $property->area }} m²</p>
                        <p><strong>Status:</strong> <span class="{{ $property->status === 'available' ? 'text-green-600' : 'text-red-600' }}">{{ ucfirst($property->status) }}</span></p>
                    </div>

                    <div class="mt-4">
                        <h2 class="text-xl font-semibold mb-2">Description</h2>
                        <p class="text-gray-700">{{ $property->description ?? 'No description available for this property.' }}</p>
                    </div>
                </div>

                <!-- Agent & Controls Column -->
                <div class="md:w-80 bg-gray-50 rounded-xl p-6 shadow-inner flex flex-col gap-4">
                    <h2 class="text-xl font-semibold mb-4">Agent Information</h2>
                    <p><strong>Name:</strong> {{ $property->agent->first_name }} {{ $property->agent->last_name }}</p>
                    <p><strong>Email:</strong> {{ $property->agent->email ?? 'N/A' }}</p>
                    <p><strong>Phone:</strong> {{ $property->agent->phone ?? 'N/A' }}</p>

                    @auth
                        @if(auth()->user()->role === 'admin' || (auth()->user()->role === 'agent' && $property->agent_id === auth()->user()->agent->id))
                            <div class="mt-6 flex flex-col gap-3">
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

        <!-- Optional: Similar Properties -->
        {{--
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-4">You may also like</h2>
            <div class="grid md:grid-cols-3 gap-8">
                @foreach($similarProperties as $similar)
                    <x-property-card :property="$similar" />
                @endforeach
            </div>
        </div>
        --}}

    </section>
@endsection
