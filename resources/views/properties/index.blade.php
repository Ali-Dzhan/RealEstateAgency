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

    <!-- Properties Slider -->
    <section class="custom-cards-wrapper py-16 px-6 md:px-12">
        <div id="slider" class="splide">
            <div class="splide__track">
                <ul class="splide__list">
                    @foreach($properties as $property)
                        <li class="splide__slide">
                            <section class="card">
                                <figure>
                                    <div class="img-overlay {{ in_array($property->id, $hotIds ?? []) ? 'hot-home' : '' }}">
                                        <img src="{{ asset($property->photos->first()->path ?? 'images/default.png') }}" alt="Property">
                                        <div class="overlay">
                                            <a href="{{ route('properties.show', $property->id) }}">View Property</a>
                                        </div>
                                    </div>
                                    <figcaption>{{ $property->address }}</figcaption>
                                </figure>

                                <div class="card-content">
                                    <section class="icons-home text-slate-700">
                                        <div class="name-icon">
                                            <i class="fa-solid fa-house"></i>
                                            <span class="value">{{ $property->type->name }}</span>
                                        </div>
                                        <div class="name-icon">
                                            <i class="fa-solid fa-bed"></i>
                                            <span class="value">{{ $property->rooms }}</span>
                                        </div>
                                        <div class="name-icon">
                                            <i class="fa-solid fa-ruler-combined"></i>
                                            <span class="value">{{ $property->area }} m²</span>
                                        </div>
                                        <div class="name-icon">
                                            <i class="fa-solid fa-user-tie"></i>
                                            <span class="value">{{ $property->agent->first_name }} {{ $property->agent->last_name }}</span>
                                        </div>
                                    </section>

                                    <section class="price">
                                        <span>${{ number_format($property->price, 0) }}</span>
                                    </section>
                                </div>
                            </section>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </section>

    <!-- Pagination -->
    <div class="mt-8">
        {{ $properties->onEachSide(1)->links() }}
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if(document.querySelector('#slider')){
                new Splide('#slider', {
                    type       : 'loop',
                    perPage    : 3,
                    gap        : '1rem',
                    speed      : 1000,
                    pagination : true,
                    rewind     : true,
                    focus      : 'center',
                    breakpoints: {
                        1280: { perPage: 2, gap: '1.5rem' },
                        768: { perPage: 1, gap: '1rem' },
                    },
                }).mount();
            }
        });
    </script>
@endsection
