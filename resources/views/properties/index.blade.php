@extends('layouts.app')

@section('content')
    <section class="relative bg-gray-900 pt-32 pb-60 px-6 w-full">
        <div class="absolute inset-0 overflow-hidden">
            <img src="https://images.unsplash.com/photo-1512917774080-9991f1c4c750?auto=format&fit=crop&q=80&w=2000"
                 class="w-full h-full object-cover opacity-50" alt="Background">
            <div class="absolute inset-0 bg-gradient-to-b from-black/10 via-black/30 to-black/70"></div>
        </div>

        <div class="relative z-10 max-w-7xl mx-auto">
            <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6 text-center md:text-left">
                <div>
                    <h1 class="text-4xl md:text-6xl font-extrabold text-white mb-4 tracking-tight drop-shadow-lg">Available Properties</h1>
                    <p class="text-gray-200 font-light text-xl max-w-xl">Discover your perfect space from our curated listings.</p>
                </div>

                @auth
                    @if(in_array(auth()->user()->role, ['agent', 'admin']))
                        <a href="{{ route('properties.create') }}"
                           class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl transition-all shadow-xl shadow-blue-600/40 flex items-center gap-2 transform hover:scale-105">
                            <i class="fa-solid fa-plus"></i> List Property
                        </a>
                    @endif
                @endauth
            </div>

            <form action="{{ route('properties.index') }}" method="GET"
                  class="bg-white p-3 rounded-2xl shadow-2xl flex flex-col lg:flex-row gap-3 items-stretch lg:items-center relative z-30 -mb-60 md:-mb-56 border border-gray-100">

                <div class="flex-[2.5] relative">
                    <i class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="location" placeholder="City or Address"
                           value="{{ request('location') }}"
                           class="w-full pl-11 p-4 rounded-xl border-none bg-gray-50 text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 outline-none">
                </div>

                <div class="relative flex-1 min-w-[160px]">
                    <i class="fa-solid fa-house absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 z-10"></i>
                    <select name="type"
                            class="w-full pl-11 p-4 rounded-xl border-none text-gray-700 bg-gray-50 appearance-none focus:ring-2 focus:ring-blue-500 outline-none cursor-pointer">
                        <option value="" disabled selected>Type</option>
                        @foreach($types as $type)
                            <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                                {{ $type->name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex flex-1 gap-2 min-w-[200px]">
                    <input type="number" name="min_price" placeholder="Min €"
                           value="{{ request('min_price') }}"
                           class="w-1/2 p-4 rounded-xl border-none bg-gray-50 text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                    <input type="number" name="max_price" placeholder="Max €"
                           value="{{ request('max_price') }}"
                           class="w-1/2 p-4 rounded-xl border-none bg-gray-50 text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                </div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl transition-all shadow-lg shadow-blue-500/20">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </section>

    <section class="custom-cards-wrapper bg-gray-50 block clear-both relative px-6 w-full">

        <div class="h-13 md:h-10"></div>

        <div class="max-w-7xl mx-auto">
            <div id="slider" class="splide">
                <div class="splide__track">
                    <ul class="splide__list">
                        @foreach($properties as $property)
                            <li class="splide__slide py-8">
                                <section class="card bg-white rounded-xl shadow-sm hover:shadow-xl transition-all duration-300">
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
                                                <span class="value text-xs">{{ $property->type->name }}</span>
                                            </div>
                                            <div class="name-icon">
                                                <i class="fa-solid fa-bed"></i>
                                                <span class="value text-xs">{{ $property->rooms }}</span>
                                            </div>
                                            <div class="name-icon">
                                                <i class="fa-solid fa-ruler-combined"></i>
                                                <span class="value text-xs">{{ $property->area }} m²</span>
                                            </div>
                                            <div class="name-icon">
                                                <i class="fa-solid fa-user-tie"></i>
                                                <span class="value text-xs">{{ $property->agent->first_name }}</span>
                                            </div>
                                        </section>

                                        <section class="price font-bold text-blue-600">
                                            <span>€{{ number_format($property->price, 0) }}</span>
                                        </section>
                                    </div>
                                </section>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <div class="mt-8 flex flex-col md:flex-row justify-between items-center gap-4 border-t border-gray-200 pt-8 pb-12">
                <p class="text-sm text-gray-500">
                    Showing {{ $properties->firstItem() }} to {{ $properties->lastItem() }} of {{ $properties->total() }} results
                </p>
                <div class="custom-pagination">
                    {{ $properties->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    </section>

    <style>
        .custom-cards-wrapper {
            position: relative !important;
            display: block !important;
            width: 100% !important;
            z-index: 10;
        }

        /* Fixes for Splide UI */
        .splide__pagination {
            bottom: -1.5rem !important;
        }

        .splide__arrow {
            background: white !important;
            opacity: 1 !important;
            box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            if(document.querySelector('#slider')){
                new Splide('#slider', {
                    type       : 'loop',
                    perPage    : 3,
                    gap        : '2rem',
                    speed      : 800,
                    pagination : true,
                    arrows     : true,
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
