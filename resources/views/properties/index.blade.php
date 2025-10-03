@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <section class="py-12 px-6 md:px-12 bg-gray-100">
        <div class="max-w-7xl mx-auto">
            <h1 class="text-3xl md:text-4xl font-bold mb-4 text-center">All Properties</h1>
            <p class="text-gray-600 text-center mb-8">Browse all available properties and find your dream home.</p>

            <!-- Search / Filter Form -->
            <form action="{{ route('properties.index') }}" method="GET"
                  class="bg-white rounded-lg shadow-lg p-6 flex flex-wrap gap-4 justify-center">

                <input type="text" name="location" placeholder="City or Address"
                       value="{{ request('location') }}"
                       class="flex-1 p-3 border rounded-lg text-black placeholder-gray-400">

                <select name="type" class="border rounded-lg text-black bg-white">
                    <option value="" disabled selected class="text-gray-500">Property Type</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>

                <input type="number" name="min_price" placeholder="Min Price €"
                       value="{{ request('min_price') }}"
                       class="p-3 border rounded-lg w-32 text-black placeholder-gray-400">

                <input type="number" name="max_price" placeholder="Max Price €"
                       value="{{ request('max_price') }}"
                       class="p-3 border rounded-lg w-32 text-black placeholder-gray-400">

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 rounded-lg">
                    Search
                </button>
            </form>
        </div>
    </section>

    <!-- Properties Grid -->
    <section class="py-16 px-6 md:px-12">
        <div class="max-w-7xl mx-auto">
            @if($properties->isEmpty())
                <p class="text-center text-gray-600">No properties found.</p>
            @else
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($properties as $property)
                        <div class="bg-white rounded-2xl shadow-lg overflow-hidden hover:scale-105 transition transform">
                            <img src="{{ asset($property->photos->first()->path ?? 'images/default.png') }}"
                                 alt="Property"
                                 class="w-full h-48 object-cover">
                            <div class="p-6">
                                <h3 class="text-xl font-semibold mb-2">{{ $property->address }}</h3>
                                <p class="text-gray-600 mb-1">Type: {{ $property->type->name }}</p>
                                <p class="text-gray-600 mb-1">Region: {{ $property->region->name }}</p>
                                <p class="text-gray-600 mb-1">Agent: {{ $property->agent->first_name }} {{ $property->agent->last_name }}</p>
                                <p class="text-lg font-bold text-blue-600 mb-2">{{ number_format($property->price, 0) }} €</p>
                                <p class="text-gray-500 text-sm mb-4">{{ $property->area }} m² — {{ $property->rooms }} rooms — {{ ucfirst($property->status) }}</p>
                                <a href="{{ route('properties.show', $property->id) }}"
                                   class="inline-block bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                    View Details
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination (if using paginate instead of get) -->
                {{-- {{ $properties->links() }} --}}
            @endif
        </div>
    </section>
@endsection
