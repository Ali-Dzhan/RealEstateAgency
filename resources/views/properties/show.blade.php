@extends('layouts.app')

@section('content')
    <section class="py-12 px-6 md:px-12 max-w-7xl mx-auto">

        <!-- Property Images -->
        <div class="mb-8">
            @if($property->photos->isNotEmpty())
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @foreach($property->photos as $photo)
                        <img src="{{ asset($photo->path) }}"
                             alt="Property photo"
                             class="w-full h-64 object-cover rounded-xl shadow-lg">
                    @endforeach
                </div>
            @else
                <img src="{{ asset('images/default.png') }}"
                     alt="Property"
                     class="w-full h-96 object-cover rounded-xl shadow-lg">
            @endif
        </div>

        <!-- Property Info & Agent -->
        <div class="grid md:grid-cols-2 gap-8">

            <!-- Property Details -->
            <div>
                <h1 class="text-3xl font-bold mb-2">{{ $property->address }}</h1>
                <p class="text-blue-600 text-2xl font-semibold mb-4">{{ number_format($property->price, 0) }} €</p>

                <p class="text-gray-600 mb-1"><strong>Type:</strong> {{ $property->type->name }}</p>
                <p class="text-gray-600 mb-1"><strong>Region:</strong> {{ $property->region->name }}</p>
                <p class="text-gray-600 mb-1"><strong>Rooms:</strong> {{ $property->rooms }}</p>
                <p class="text-gray-600 mb-1"><strong>Area:</strong> {{ $property->area }} m²</p>
                <p class="text-gray-600 mb-1"><strong>Status:</strong> {{ ucfirst($property->status) }}</p>
            </div>

            <!-- Agent & Purchase -->
            <div class="bg-white p-6 rounded-xl shadow-lg">
                <h2 class="text-xl font-semibold mb-4">Agent Information</h2>
                <p><strong>Name:</strong> {{ $property->agent->first_name }} {{ $property->agent->last_name }}</p>
                <p><strong>Email:</strong> {{ $property->agent->email ?? 'N/A' }}</p>
                <p><strong>Phone:</strong> {{ $property->agent->phone ?? 'N/A' }}</p>

                @if($property->status === 'available')
                    <form action="{{ route('properties.purchase', $property->id) }}" method="POST" class="mt-6">
                        @csrf
                        <button type="submit" class="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-lg">
                            Buy Now
                        </button>
                    </form>
                @else
                    <span class="inline-block mt-6 bg-red-600 text-white px-4 py-2 rounded-lg font-semibold">
                    Sold
                </span>
                @endif
            </div>
        </div>

        <!-- Description -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold mb-4">Property Description</h2>
            <p class="text-gray-700">
                {{ $property->description ?? 'No description available for this property.' }}
            </p>
        </div>

        <!-- Optional: Similar Properties / Recommendations -->
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


