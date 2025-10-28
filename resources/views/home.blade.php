{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--    <!-- Hero Section -->--}}
{{--    <section class="relative bg-gray-900 text-white">--}}
{{--        <div class="absolute inset-0">--}}
{{--            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c"--}}
{{--                 alt="Real Estate"--}}
{{--                 class="w-full h-full object-cover opacity-60">--}}
{{--        </div>--}}

{{--        <div class="relative z-10 flex flex-col items-center justify-center text-center py-32 px-4">--}}
{{--            <h1 class="text-4xl md:text-6xl font-bold mb-6 tracking-tight">Find Your Dream Home</h1>--}}
{{--            <p class="mb-8 text-lg md:text-xl font-light">Browse thousands of properties across Bulgaria</p>--}}

{{--            <!-- Search Form -->--}}
{{--            <form action="{{ route('properties.index') }}" method="GET"--}}
{{--                  class="bg-white shadow-lg p-6 w-full max-w-3xl flex flex-wrap gap-4 justify-center items-center">--}}
{{--                @csrf--}}
{{--                <input type="text" name="location" placeholder="City or Address"--}}
{{--                       value="{{ request('location') }}"--}}
{{--                       class="flex-1 p-3 border border-gray-300 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">--}}

{{--                <select name="type" class="border border-gray-300 text-gray-700 bg-white p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">--}}
{{--                    <option value="" disabled selected class="text-gray-500">Property Type</option>--}}
{{--                    @foreach($types as $type)--}}
{{--                        <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>--}}
{{--                            {{ $type->name }}--}}
{{--                        </option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}

{{--                <input type="number" name="min_price" placeholder="Min €"--}}
{{--                       value="{{ request('min_price') }}"--}}
{{--                       class="p-3 border border-gray-300 w-28 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">--}}

{{--                <input type="number" name="max_price" placeholder="Max €"--}}
{{--                       value="{{ request('max_price') }}"--}}
{{--                       class="p-3 border border-gray-300 w-28 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">--}}

{{--                <button type="submit"--}}
{{--                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 transition">--}}
{{--                    Search--}}
{{--                </button>--}}
{{--            </form>--}}
{{--        </div>--}}
{{--    </section>--}}

{{--    <!-- Featured Properties -->--}}
{{--    <section class="py-16 px-6 md:px-12 bg-gray-100">--}}
{{--        <h2 class="text-3xl font-bold text-center mb-12 text-gray-900">Featured Properties</h2>--}}

{{--        <div class="grid md:grid-cols-3 sm:grid-cols-2 grid-cols-1 gap-10 max-w-7xl mx-auto">--}}
{{--            @foreach($featured as $property)--}}
{{--                <div class="bg-white shadow-md hover:shadow-lg transition-all duration-300 overflow-hidden">--}}
{{--                    <img src="{{ asset($property->photos->first()->path ?? 'images/default.png') }}"--}}
{{--                         alt="Property"--}}
{{--                         class="w-full h-52 object-cover">--}}

{{--                    <div class="p-6 border-t border-gray-200">--}}
{{--                        <h3 class="text-xl font-semibold text-gray-800 mb-2">{{ $property->address }}</h3>--}}
{{--                        <p class="text-gray-600 mb-2 text-sm">Agent:--}}
{{--                            <span class="font-medium text-gray-800">{{ $property->agent->first_name }} {{ $property->agent->last_name }}</span>--}}
{{--                        </p>--}}
{{--                        <p class="text-lg font-bold text-blue-600 mb-4">{{ number_format($property->price, 0) }} €</p>--}}
{{--                        <a href="{{ route('properties.show', $property->id) }}"--}}
{{--                           class="inline-block bg-blue-600 text-white px-5 py-2 text-sm font-semibold hover:bg-blue-700 transition">--}}
{{--                            View Details--}}
{{--                        </a>--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--            @endforeach--}}
{{--        </div>--}}
{{--    </section>--}}
{{--@endsection--}}


@extends('layouts.app')

@section('content')
    <!-- HERO SECTION -->
    <section class="relative bg-gray-900 text-white">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c"
                 alt="Real Estate"
                 class="w-full h-full object-cover opacity-60">
        </div>

        <div class="relative z-10 flex flex-col items-center justify-center text-center py-32 px-4">
            <h1 class="text-4xl md:text-6xl font-bold mb-6 tracking-tight">Find Your Dream Home</h1>
            <p class="mb-8 text-lg md:text-xl font-light">Browse thousands of properties across Bulgaria</p>

            <!-- Search Form -->
            <form action="{{ route('properties.index') }}" method="GET"
                  class="bg-white shadow-lg p-6 w-full max-w-3xl flex flex-wrap gap-4 justify-center items-center">
                @csrf
                <input type="text" name="location" placeholder="City or Address"
                       value="{{ request('location') }}"
                       class="flex-1 p-3 border border-gray-300 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">

                <select name="type"
                        class="border border-gray-300 text-gray-700 bg-white p-3 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    <option value="" disabled selected class="text-gray-500">Property Type</option>
                    @foreach($types as $type)
                        <option value="{{ $type->id }}" {{ request('type') == $type->id ? 'selected' : '' }}>
                            {{ $type->name }}
                        </option>
                    @endforeach
                </select>

                <input type="number" name="min_price" placeholder="Min €"
                       value="{{ request('min_price') }}"
                       class="p-3 border border-gray-300 w-28 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">

                <input type="number" name="max_price" placeholder="Max €"
                       value="{{ request('max_price') }}"
                       class="p-3 border border-gray-300 w-28 text-gray-700 placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-blue-500">

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-3 transition">
                    Search
                </button>
            </form>
        </div>
    </section>

    <!-- STATS SECTION -->
    <section class="relative z-20 -mt-24">
        <div class="max-w-6xl mx-auto bg-white shadow-xl rounded-2xl py-12 px-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 text-center">
            <div class="flex flex-col items-center">
                <i class="fa-solid fa-user-tie text-blue-600 text-4xl mb-3"></i>
                <h2 class="counter text-4xl font-bold text-blue-700" data-target="{{ $agentsCount ?? 20000 }}">0</h2>
                <p class="text-gray-700 mt-2 text-lg font-medium">Agents</p>
            </div>
            <div class="flex flex-col items-center">
                <i class="fa-solid fa-file-signature text-blue-600 text-4xl mb-3"></i>
                <h2 class="counter text-4xl font-bold text-blue-700" data-target="{{ $transactionsCount ?? 1723000 }}">0</h2>
                <p class="text-gray-700 mt-2 text-lg font-medium">Transactions</p>
            </div>
            <div class="flex flex-col items-center">
                <i class="fa-solid fa-building text-blue-600 text-4xl mb-3"></i>
                <h2 class="counter text-4xl font-bold text-blue-700" data-target="{{ $agenciesCount ?? 17414 }}">0</h2>
                <p class="text-gray-700 mt-2 text-lg font-medium">Agencies</p>
            </div>
            <div class="flex flex-col items-center">
                <i class="fa-solid fa-map-location-dot text-blue-600 text-4xl mb-3"></i>
                <h2 class="counter text-4xl font-bold text-blue-700" data-target="{{ $suburbsCount ?? 10200 }}">0</h2>
                <p class="text-gray-700 mt-2 text-lg font-medium">Suburbs</p>
            </div>
        </div>
    </section>

    <!-- HOW IT WORKS -->
    <section class="howItWorks">
        <h4 class="title">How It Works</h4>
        <hr class="titleMark">
        <div class="steps">
            <div class="step">
                <i class="fa fa-search fa-3x"></i>
                <h3>Browse</h3>
                <p>Explore listings by location, type, or price range.</p>
            </div>
            <div class="step">
                <i class="fa fa-envelope-open-text fa-3x"></i>
                <h3>Connect</h3>
                <p>Reach out to agents and get expert guidance instantly.</p>
            </div>
            <div class="step">
                <i class="fa fa-home fa-3x"></i>
                <h3>Move In</h3>
                <p>Seal the deal and move into your perfect property.</p>
            </div>
        </div>
    </section>
    <!-- COUNTER SCRIPT -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.counter');
            const speed = 480;

            const animateCounters = () => {
                counters.forEach(counter => {
                    const updateCount = () => {
                        const target = +counter.getAttribute('data-target');
                        const count = +counter.innerText;
                        const inc = target / speed;
                        if (count < target) {
                            counter.innerText = Math.ceil(count + inc);
                            setTimeout(updateCount, 15);
                        } else {
                            counter.innerText = target;
                        }
                    };
                    updateCount();
                });
            };

            const stats = document.querySelector('.stats-float') || document.querySelector('section.relative');
            new IntersectionObserver(entries => {
                entries.forEach(e => {
                    if (e.isIntersecting) {
                        animateCounters();
                    }
                });
            }, { threshold: 0.4 }).observe(stats);
        });
    </script>
@endsection

