@extends('layouts.app')

@section('content')
    <!-- Hero Section -->
    <section class="relative bg-gray-900 text-white">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c"
                 alt="Real Estate"
                 class="w-full h-full object-cover opacity-60">
        </div>
        <div class="relative z-10 flex flex-col items-center justify-center text-center py-32 px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-6">Find Your Dream Home</h1>
            <p class="mb-8 text-lg md:text-xl">Browse thousands of properties across Bulgaria</p>

            <!-- Search Form -->
            <form action="{{ route('properties.index') }}" method="GET"
                  class="bg-white rounded-lg shadow-lg p-6 w-full max-w-3xl flex flex-wrap gap-4">
                @csrf
                <input type="text" name="location" placeholder="City or Address"
                       class="flex-1 p-3 border rounded-lg text-gray-500 placeholder-gray-500">

                <select name="type" class="p-3 border rounded-lg text-black bg-white">
                    <option value="" disabled selected class="text-gray-500">Property Type</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" class="text-black">{{ $type->name }}</option>
                    @endforeach
                </select>

                <input type="number" name="min_price" placeholder="Min Price €"
                       class="p-3 border rounded-lg w-32 text-black placeholder-gray-500">

                <input type="number" name="max_price" placeholder="Max Price €"
                       class="p-3 border rounded-lg w-32 text-black placeholder-gray-500">

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg">
                    Search
                </button>
            </form>
        </div>
    </section>

    <!-- Featured Properties -->
    <section class="py-16 px-6 md:px-12">
        <h2 class="text-3xl font-bold text-center mb-12">Featured Properties</h2>

        <div class="grid md:grid-cols-3 gap-8">
            @foreach($featured as $property)
                <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:scale-105 transition">
                    <img src="{{ asset($property->photos->first()->path ?? 'images/default.png') }}"
                         alt="Property"
                         class="w-full h-48 object-cover">
                    <div class="p-6">
                        <h3 class="text-xl font-semibold mb-2">{{ $property->address }}</h3>
                        <p class="text-gray-600 mb-2">Agent: {{ $property->agent->first_name }}</p>
                        <p class="text-lg font-bold text-blue-600 mb-4">{{ number_format($property->price, 0) }} € </p>
                        <a href="{{ route('properties.show', $property->id) }}"
                           class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                            View Details
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
@endsection
