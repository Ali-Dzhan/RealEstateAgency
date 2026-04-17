@extends('layouts.app')

@section('fullwidth')
    {{-- Hero Section --}}
    <section class="relative bg-gray-900 min-h-[55vh] flex items-center px-6 w-full overflow-hidden">

        {{-- Background --}}
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&q=80&w=2000"
                 class="w-full h-full object-cover scale-105 opacity-50"
                 alt="Modern Real Estate">
            <div class="absolute inset-0 bg-gradient-to-b from-black/20 via-black/50 to-black/80"></div>
        </div>

        {{-- Content --}}
        <div class="relative z-10 max-w-7xl mx-auto w-full">

            <div class="flex flex-col lg:flex-row justify-between items-start lg:items-end gap-10 mb-12">

                {{-- Text --}}
                <div>
                    <h1 class="text-4xl md:text-7xl font-extrabold text-white mb-6 tracking-tight leading-tight">
                        Find Your <span class="text-blue-500">Perfect Home</span>
                    </h1>

                    <p class="text-gray-300 text-lg md:text-xl max-w-xl font-light">
                        Explore premium properties across Bulgaria with powerful search tools.
                    </p>
                </div>

                {{-- CTA --}}
                @auth
                    @if(in_array(auth()->user()->role, ['agent', 'admin']))
                        <a href="{{ route('properties.create') }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-2xl transition-all shadow-xl shadow-blue-600/30 flex items-center gap-2 hover:-translate-y-1">
                            <i class="fa-solid fa-plus"></i> List Property
                        </a>
                    @endif
                @endauth
            </div>

            {{-- Search Bar (INSIDE banner) --}}
            <form action="{{ route('properties.index') }}" method="GET"
                  class="bg-white/90 backdrop-blur-md p-4 rounded-3xl shadow-2xl flex flex-col lg:flex-row gap-4 items-stretch lg:items-center border border-white/40">

                <div class="flex-[2] relative">
                    <i class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-blue-500"></i>
                    <input type="text" name="location" placeholder="City or Address"
                           value="{{ request('location') }}"
                           class="w-full pl-12 p-4 rounded-2xl border-0 bg-gray-50 text-gray-700 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div class="relative flex-1">
                    <i class="fa-solid fa-house absolute left-4 top-1/2 -translate-y-1/2 text-blue-500 z-10"></i>
                    <select name="type"
                            class="w-full pl-12 p-4 rounded-2xl border-0 text-gray-700 bg-gray-50 appearance-none focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer">
                        <option value="" disabled selected>Property Type</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-1 gap-2">
                    <input type="number" name="min_price" placeholder="Min €"
                           value="{{ request('min_price') }}"
                           class="w-1/2 p-4 rounded-2xl border-0 bg-gray-50 text-gray-700 focus:ring-2 focus:ring-blue-500 outline-none">
                    <input type="number" name="max_price" placeholder="Max €"
                           value="{{ request('max_price') }}"
                           class="w-1/2 p-4 rounded-2xl border-0 bg-gray-50 text-gray-700 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-800 text-white font-bold px-10 py-4 rounded-2xl transition-all flex items-center justify-center gap-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <span class="lg:hidden">Search</span>
                </button>
            </form>

        </div>
    </section>

    {{-- Content Section --}}
    <section class="bg-gray-50 pt-32 pb-20 px-6">
        <div class="max-w-7xl mx-auto">
            <div id="slider" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($properties as $property)
                            <li class="splide__slide py-10">
                                <div class="group bg-white rounded-3xl overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-500 border border-gray-100 h-full flex flex-col">
                                    {{-- Image Wrapper --}}
                                    <div class="relative h-64 overflow-hidden">
                                        <img src="{{ asset($property->photos->first()->path ?? 'images/default.png') }}"
                                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                             alt="Property">

                                        {{-- Badge --}}
                                        <div class="absolute top-4 left-4">
                                            <span class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-lg text-xs font-bold uppercase tracking-wider text-blue-600">
                                                {{ $property->type->name }}
                                            </span>
                                        </div>

                                        {{-- Price Overlay --}}
                                        <div class="absolute bottom-4 left-4">
                                            <span class="bg-blue-600 text-white px-4 py-2 rounded-xl font-bold shadow-lg">
                                                €{{ number_format($property->price, 0) }}
                                            </span>
                                        </div>
                                    </div>

                                    {{-- Content --}}
                                    <div class="p-6 flex flex-col flex-grow">
                                        <h3 class="text-xl font-bold text-gray-800 mb-2 truncate">{{ $property->address }}</h3>

                                        <div class="grid grid-cols-3 gap-4 py-4 border-y border-gray-50 my-4 text-gray-500">
                                            <div class="flex flex-col items-center">
                                                <i class="fa-solid fa-bed text-blue-500 mb-1"></i>
                                                <span class="text-xs font-medium">{{ $property->rooms }} Beds</span>
                                            </div>
                                            <div class="flex flex-col items-center">
                                                <i class="fa-solid fa-ruler-combined text-blue-500 mb-1"></i>
                                                <span class="text-xs font-medium">{{ $property->area }} m²</span>
                                            </div>
                                            <div class="flex flex-col items-center">
                                                <i class="fa-solid fa-user-tie text-blue-500 mb-1"></i>
                                                <span class="text-xs font-medium">{{ $property->agent->first_name }}</span>
                                            </div>
                                        </div>

                                        <a href="{{ route('properties.show', $property->id) }}"
                                           class="mt-auto text-center w-full py-3 rounded-xl border-2 border-gray-100 font-semibold text-gray-600 hover:bg-blue-600 hover:text-white hover:border-blue-600 transition-colors">
                                            View Details
                                        </a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            {{-- Pagination --}}
            <div class="mt-12 flex flex-col md:flex-row justify-between items-center gap-6 border-t border-gray-200 pt-10">
                <p class="text-gray-500 font-medium">
                    Showing <span class="text-gray-900">{{ $properties->firstItem() }}</span> to <span class="text-gray-900">{{ $properties->lastItem() }}</span> of <span class="text-gray-900">{{ $properties->total() }}</span> results
                </p>
                <div class="custom-pagination">
                    {{ $properties->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </section>

    <style>
        .splide__pagination { bottom: -2rem !important; }
        .splide__pagination__page.is-active { background: #2563eb !important; transform: scale(1.4); }
        .splide__arrow { background: white !important; height: 3rem !important; width: 3rem !important; opacity: 1 !important; box-shadow: 0 10px 15px -3px rgb(0 0 0 / 0.1); }
        .splide__arrow svg { fill: #2563eb !important; }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if(document.querySelector('#slider')){
                new Splide('#slider', {
                    type       : 'loop',
                    perPage    : 3,
                    gap        : '2.5rem',
                    speed      : 800,
                    autoplay   : true,
                    interval   : 4000,
                    pagination : true,
                    arrows     : true,
                    breakpoints: {
                        1280: { perPage: 2, gap: '1.5rem' },
                        768: { perPage: 1, gap: '1rem' },
                    },
                }).mount();
            }
        });
    </script>
@endsection
