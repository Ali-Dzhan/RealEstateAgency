@extends('layouts.app')

@section('content')
    <section class="relative bg-gray-900 text-white py-32">
        <div class="absolute inset-0">
            <img src="https://images.unsplash.com/photo-1486406146926-c627a92ad1ab?auto=format&fit=crop&q=80&w=2070"
                 alt="Modern Building"
                 class="w-full h-full object-cover opacity-40">
            <div class="absolute inset-0 bg-gradient-to-b from-transparent to-gray-900"></div>
        </div>

        <div class="relative z-10 max-w-5xl mx-auto px-6 text-center">
            <h1 class="text-5xl md:text-6xl font-extrabold mb-6 tracking-tight">About RealEstate</h1>
            <p class="text-xl md:text-2xl text-gray-300 font-light leading-relaxed max-w-3xl mx-auto">
                Redefining the property search experience in Bulgaria through transparency,
                technology, and local expertise.
            </p>
        </div>
    </section>

    <section class="py-20 bg-white">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
            <div>
                <span class="text-blue-600 font-bold uppercase tracking-widest text-sm">Who We Are</span>
                <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mt-4 mb-6">Your Digital Gateway to Bulgarian Real Estate</h2>
                <p class="text-gray-600 text-lg leading-relaxed mb-6">
                    RealEstate is a comprehensive digital ecosystem designed to simplify the complex world of property transactions.
                    We provide a centralized marketplace where data meets human expertise, ensuring that every user—whether
                    buying their first apartment or selling a commercial portfolio—has the tools they need to succeed.
                </p>
                <div class="flex gap-4">
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <span class="block text-2xl font-bold text-blue-700">10k+</span>
                        <span class="text-gray-500 text-sm">Active Listings</span>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <span class="block text-2xl font-bold text-blue-700">500+</span>
                        <span class="text-gray-500 text-sm">Verified Agents</span>
                    </div>
                </div>
            </div>
            <div class="relative">
                <img src="https://images.unsplash.com/photo-1560518883-ce09059eeffa?auto=format&fit=crop&q=80&w=1000"
                     alt="Our Team"
                     class="rounded-2xl shadow-2xl relative z-10">
                <div class="absolute -bottom-6 -left-6 w-64 h-64 bg-blue-600 rounded-2xl -z-0 opacity-10"></div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-gray-50">
        <div class="max-w-7xl mx-auto px-6 text-center mb-16">
            <h2 class="text-4xl font-bold text-gray-900">Our Mission</h2>
            <p class="text-gray-600 mt-4 max-w-2xl mx-auto text-lg">We empower every participant in the real estate journey.</p>
        </div>

        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-4 gap-8">
            <div class="bg-white p-8 rounded-xl shadow-sm border-b-4 border-blue-600 hover:shadow-md transition">
                <div class="text-blue-600 mb-4"><i class="fa-solid fa-cart-shopping fa-2x"></i></div>
                <h3 class="text-xl font-bold mb-2">Buyers</h3>
                <p class="text-gray-600 text-sm">Finding the perfect home with complete price transparency and legal security.</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-sm border-b-4 border-blue-600 hover:shadow-md transition">
                <div class="text-blue-600 mb-4"><i class="fa-solid fa-key fa-2x"></i></div>
                <h3 class="text-xl font-bold mb-2">Renters</h3>
                <p class="text-gray-600 text-sm">Accessing verified rentals and flexible viewing schedules at the click of a button.</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-sm border-b-4 border-blue-600 hover:shadow-md transition">
                <div class="text-blue-600 mb-4"><i class="fa-solid fa-house-signal fa-2x"></i></div>
                <h3 class="text-xl font-bold mb-2">Sellers</h3>
                <p class="text-gray-600 text-sm">Showcasing properties to thousands of qualified leads with premium marketing tools.</p>
            </div>
            <div class="bg-white p-8 rounded-xl shadow-sm border-b-4 border-blue-600 hover:shadow-md transition">
                <div class="text-blue-600 mb-4"><i class="fa-solid fa-user-tie fa-2x"></i></div>
                <h3 class="text-xl font-bold mb-2">Agents</h3>
                <p class="text-gray-600 text-sm">Providing a professional platform to manage viewings, offers, and client relationships.</p>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-end mb-16">
                <div class="max-w-xl">
                    <h2 class="text-4xl font-bold text-gray-900 mb-4">Why Choose Us</h2>
                    <p class="text-gray-600 text-lg">Setting the gold standard for property platforms.</p>
                </div>
                <a href="{{ route('properties.index') }}" class="mt-6 md:mt-0 text-blue-600 font-bold flex items-center gap-2 hover:underline">
                    Browse Listings <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-12">
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-6 h-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12.75L11.25 15 15 9.75M21 12c0 1.268-.63 2.39-1.593 3.068a3.745 3.745 0 01-1.043 3.296 3.745 3.745 0 01-3.296 1.043A3.745 3.745 0 0112 21a3.745 3.745 0 01-3.068-1.593 3.746 3.746 0 01-3.296-1.043 3.745 3.745 0 01-1.043-3.296A3.745 3.745 0 013 12c0-1.268.63-2.39 1.593-3.068a3.745 3.745 0 011.043-3.296 3.746 3.746 0 013.296-1.043A3.746 3.746 0 0112 3c1.268 0 2.39.63 3.068 1.593a3.746 3.746 0 013.296 1.043 3.746 3.746 0 011.043 3.296A3.745 3.745 0 0121 12z" />
                        </svg>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">Trusted Listings</h4>
                        <p class="text-gray-600 text-sm">Every property is vetted to ensure accuracy in photos, pricing, and documentation.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">Easy Search</h4>
                        <p class="text-gray-600 text-sm">Advanced filters allow you to find your dream home based on exact specifications.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-award"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">Expert Agents</h4>
                        <p class="text-gray-600 text-sm">Connect with the top 5% of Bulgarian real estate professionals instantly.</p>
                    </div>
                </div>
                <div class="flex gap-4">
                    <div class="flex-shrink-0 w-12 h-12 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center">
                        <i class="fa-solid fa-comments"></i>
                    </div>
                    <div>
                        <h4 class="font-bold text-gray-900 mb-2">Smooth Communication</h4>
                        <p class="text-gray-600 text-sm">Direct messaging and automated viewing requests keep everyone in the loop.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
