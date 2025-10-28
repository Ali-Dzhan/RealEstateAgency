@extends('layouts.app')

@section('content')
    <!-- Page Header -->
    <section class="py-12 px-6 md:px-12 bg-gray-100">
        <div class="max-w-7xl mx-auto flex justify-between items-center mb-6">
            @auth
                <h1 class="text-3xl md:text-4xl font-bold">Properties</h1>
                @if(in_array(auth()->user()->role, ['agent', 'admin']))
                    <a href="{{ route('properties.create') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 transition">
                        Add Property +
                    </a>
                @endif
            @endauth
        </div>

        <!-- Search / Filter Form -->
        <form action="{{ route('properties.index') }}" method="GET"
              class="bg-white shadow-lg p-6 flex flex-wrap gap-4 justify-center">
            <input type="text" name="location" placeholder="City or Address"
                   value="{{ request('location') }}"
                   class="flex-1 p-3 border text-black placeholder-gray-400">

            <select name="type" class="border text-black bg-white">
                <option value="" disabled selected>Property Type</option>
                @foreach($types as $type)
                    <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                        {{ $type->name }}
                    </option>
                @endforeach
            </select>

            <input type="number" name="min_price" placeholder="Min Price €"
                   value="{{ request('min_price') }}"
                   class="p-3 border w-32 text-black placeholder-gray-400">

            <input type="number" name="max_price" placeholder="Max Price €"
                   value="{{ request('max_price') }}"
                   class="p-3 border w-32 text-black placeholder-gray-400">

            <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3">
                Search
            </button>
        </form>
    </section>

    <!-- Properties Grid -->
    <section class="custom-cards-wrapper py-16 px-6 md:px-12">
        <div class="container">
            <div class="cards">
                @foreach($properties as $property)
                    <section class="card">
                        <figure>
                            <div class="img-overlay hot-home">
                                <img src="{{ asset($property->photos->first()->path ?? 'images/default.png') }}" alt="Property">
                                <div class="overlay">
                                    <a href="{{ route('properties.show', $property->id) }}">View Property</a>
                                </div>
                            </div>
                            <figcaption>{{ $property->address }}</figcaption>
                        </figure>

                        <div class="card-content">
                            <section class="icons-home">
                                <div class="name-icon">
                                    <span>Type</span>
                                    <div class="icon">
                                        <i class="fas fa-home"></i>
                                        <span>{{ $property->type->name }}</span>
                                    </div>
                                </div>
                                <div class="name-icon">
                                    <span>Rooms</span>
                                    <div class="icon">
                                        <i class="fas fa-bed"></i>
                                        <span>{{ $property->rooms }}</span>
                                    </div>
                                </div>
                                <div class="name-icon">
                                    <span>Area</span>
                                    <div class="icon">
                                        <i class="fas fa-vector-square"></i>
                                        <span>{{ $property->area }} m²</span>
                                    </div>
                                </div>
                                <div class="name-icon">
                                    <span>Agent</span>
                                    <div class="icon">
                                        <i class="fas fa-user"></i>
                                        <span>{{ $property->agent->first_name }} {{ $property->agent->last_name }}</span>
                                    </div>
                                </div>
                            </section>

                            <section class="price">
                                <span>${{ number_format($property->price, 0) }}</span>
                            </section>
                        </div>
                    </section>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Pagination -->
    <div class="pagination-wrapper mt-8 flex justify-center">
        {{ $properties->links() }}
    </div>
@endsection
