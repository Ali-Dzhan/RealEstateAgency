@extends('layouts.app')

@section('fullwidth')
    <section class="relative bg-gray-900 text-white overflow-hidden">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1600585154340-be6161a56a0c?auto=format&fit=crop&q=80&w=2000"
                 alt="Real Estate"
                 class="w-full h-full object-cover opacity-50 scale-105 transition-transform duration-1000">
            <div class="absolute inset-0 bg-gradient-to-b from-gray-900/20 via-gray-900/40 to-gray-900"></div>
        </div>

        <div class="relative z-10 flex flex-col items-center justify-center text-center py-32 md:py-48 px-4">
            <span class="bg-blue-600/20 text-blue-400 border border-blue-500/30 text-xs font-bold uppercase px-4 py-1.5 rounded-full mb-6 tracking-widest">
                Premium Real Estate Bulgaria
            </span>
            <h1 class="text-5xl md:text-7xl font-extrabold mb-6 tracking-tight leading-tight">
                Find Your <span class="text-blue-500">Dream Home</span>
            </h1>
            <p class="mb-10 text-lg md:text-2xl font-light text-gray-300 max-w-2xl">
                Browse thousands of exclusive properties across the most desirable locations.
            </p>

            <form action="{{ route('properties.index') }}" method="GET"
                  class="bg-white p-2 md:p-3 rounded-2xl shadow-2xl w-full max-w-5xl flex flex-col md:flex-row gap-2 items-stretch md:items-center">
                @csrf

                <div class="flex-[1.25] relative">
                    <i class="fa-solid fa-location-dot absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text" name="location" placeholder="City or Address"
                           value="{{ request('location') }}"
                           class="w-full pl-11 p-4 rounded-xl border-none text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 outline-none">
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

                <div class="flex flex-1 gap-1 min-w-[180px]">
                    <input type="number" name="min_price" placeholder="Min €"
                           value="{{ request('min_price') }}"
                           class="w-1/2 px-3 py-4 rounded-xl border-none bg-gray-50 text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                    <input type="number" name="max_price" placeholder="Max €"
                           value="{{ request('max_price') }}"
                           class="w-1/2 px-3 py-4 rounded-xl border-none bg-gray-50 text-gray-700 placeholder-gray-400 focus:ring-2 focus:ring-blue-500 outline-none text-sm">
                </div>

                <button type="submit"
                        class="bg-blue-600 hover:bg-blue-700 text-white font-bold px-8 py-4 rounded-xl transition-all shadow-lg shadow-blue-500/30 flex items-center justify-center gap-2">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </form>
        </div>
    </section>

    <section class="relative py-24 bg-gradient-to-b from-gray-50 via-white to-gray-100 overflow-hidden">

        {{-- subtle pattern --}}
        <div class="absolute inset-0 opacity-[0.03] bg-[radial-gradient(#000_1px,transparent_1px)] [background-size:20px_20px]"></div>

        {{-- top divider for smoother transition --}}
        <div class="absolute top-0 left-0 w-full h-16 bg-gradient-to-b from-gray-100 to-transparent"></div>

        <div class="relative max-w-7xl mx-auto px-6 lg:px-8">

            {{-- heading --}}
            <div class="text-center mb-20">
                <h2 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">
                    How It Works
                </h2>

                <div class="w-20 h-1.5 bg-blue-600 mx-auto rounded-full mb-6"></div>

                <p class="text-gray-500 text-lg max-w-2xl mx-auto font-light">
                    Buying or selling a home in Bulgaria has never been easier. Follow our simple three-step process.
                </p>
            </div>

            {{-- steps --}}
            <div class="grid md:grid-cols-3 gap-12 relative">

                {{-- connecting line --}}
                <div class="hidden md:block absolute top-1/2 left-0 w-full h-0.5 bg-gray-200 -z-0"></div>

                {{-- card 1 --}}
                <div class="relative z-10 bg-white/80 backdrop-blur-sm group p-10 rounded-3xl border border-gray-200 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 text-center">
                    <div class="w-20 h-20 bg-blue-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-8 rotate-3 group-hover:rotate-0 transition-transform">
                        <i class="fa-solid fa-search fa-2x"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">1. Browse</h3>
                    <p class="text-gray-600 font-light leading-relaxed">
                        Explore thousands of verified listings by location, property type, or price range.
                    </p>
                </div>

                {{-- card 2 --}}
                <div class="relative z-10 bg-white/80 backdrop-blur-sm group p-10 rounded-3xl border border-gray-200 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 text-center">
                    <div class="w-20 h-20 bg-blue-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-8 -rotate-3 group-hover:rotate-0 transition-transform">
                        <i class="fa-solid fa-envelope-open-text fa-2x"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">2. Connect</h3>
                    <p class="text-gray-600 font-light leading-relaxed">
                        Book viewings directly and get expert guidance from our certified local agents.
                    </p>
                </div>

                {{-- card 3 --}}
                <div class="relative z-10 bg-white/80 backdrop-blur-sm group p-10 rounded-3xl border border-gray-200 shadow-lg hover:shadow-2xl transition-all duration-300 hover:-translate-y-2 text-center">
                    <div class="w-20 h-20 bg-blue-600 text-white rounded-2xl flex items-center justify-center mx-auto mb-8 rotate-1 group-hover:rotate-0 transition-transform">
                        <i class="fa-solid fa-house-circle-check fa-2x"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-4 text-gray-900">3. Move In</h3>
                    <p class="text-gray-600 font-light leading-relaxed">
                        Secure your dream home with transparent offers and smooth legal paperwork.
                    </p>
                </div>

            </div>
        </div>
    </section>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const counters = document.querySelectorAll('.counter');
            const speed = 1000; // Adjusted speed for better feel

            const animateCounters = () => {
                counters.forEach(counter => {
                    const updateCount = () => {
                        const target = +counter.getAttribute('data-target');
                        const count = +counter.innerText.replace(/,/g, '');
                        const inc = target / speed;

                        if (count < target) {
                            counter.innerText = Math.ceil(count + inc).toLocaleString();
                            setTimeout(updateCount, 10);
                        } else {
                            counter.innerText = target.toLocaleString();
                        }
                    };
                    updateCount();
                });
            };

            // Improved Intersection Observer
            const statsSection = document.querySelector('.counter')?.closest('section');
            if (statsSection) {
                const observer = new IntersectionObserver(entries => {
                    entries.forEach(e => {
                        if (e.isIntersecting) {
                            animateCounters();
                            observer.unobserve(e.target); // Run only once
                        }
                    });
                }, { threshold: 0.5 });
                observer.observe(statsSection);
            }
        });
    </script>
@endsection
