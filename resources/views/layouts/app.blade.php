<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Real Estate') }}</title>

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" sizes="32x32">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" sizes="32x32">


        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link href="{{ asset('css/custom-cards.css') }}" rel="stylesheet">
        <link href="{{ asset('css/home.css') }}" rel="stylesheet">

        <!-- Splide CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/css/splide.min.css">

        <!-- Splide JS -->
        <script src="https://cdn.jsdelivr.net/npm/@splidejs/splide@4.1.4/dist/js/splide.min.js"></script>



    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                @yield('fullwidth')

                <div class="max-w-7xl mx-auto pt-6 px-4 sm:px-6 lg:px-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </body>

    <footer class="bg-gray-950 text-white relative overflow-hidden">
        {{-- Top Border Glow --}}
        <div class="absolute top-0 left-0 w-full h-px bg-gradient-to-r from-transparent via-blue-500 to-transparent"></div>

        <div class="max-w-7xl mx-auto px-6 lg:px-8 py-20">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-14">

                {{-- Brand --}}
                <div class="space-y-6">
                    <img src="{{ asset('images/real_estate_logo_transparent.png') }}"
                         alt="Real Estate Logo"
                         class="h-12 w-auto">

                    <p class="text-gray-400 leading-relaxed text-sm">
                        The leading property platform in Bulgaria.
                        Discover premium homes, trusted agents,
                        and modern real estate experiences.
                    </p>

                    <div class="flex items-center gap-4 pt-2">
                        <a href="#" class="text-gray-500 hover:text-white transition" aria-label="Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M22 12a10 10 0 1 0-11.5 9.9v-7h-2.5V12h2.5V9.8c0-2.5 1.5-3.9 3.8-3.9 1.1 0 2.2.2 2.2.2v2.4h-1.2c-1.2 0-1.6.8-1.6 1.5V12h2.7l-.4 2.9h-2.3v7A10 10 0 0 0 22 12z"/>
                            </svg>
                        </a>

                        <a href="#" class="text-gray-500 hover:text-white transition" aria-label="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M7 2h10a5 5 0 0 1 5 5v10a5 5 0 0 1-5 5H7a5 5 0 0 1-5-5V7a5 5 0 0 1 5-5zm0 2a3 3 0 0 0-3 3v10a3 3 0 0 0 3 3h10a3 3 0 0 0 3-3V7a3 3 0 0 0-3-3H7zm5 3.5A4.5 4.5 0 1 1 12 16a4.5 4.5 0 0 1 0-9zm0 2A2.5 2.5 0 1 0 12 14a2.5 2.5 0 0 0 0-5zm5.2-2.6a1.1 1.1 0 1 1-1.1 1.1 1.1 1.1 0 0 1 1.1-1.1z"/>
                            </svg>
                        </a>

                        <a href="#" class="text-gray-500 hover:text-white transition" aria-label="LinkedIn">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M4.98 3.5a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5zM3 9h4v12H3V9zm7 0h3.8v1.6h.1c.5-.9 1.8-1.9 3.7-1.9 4 0 4.7 2.6 4.7 6V21h-4v-5.6c0-1.3 0-3-1.9-3s-2.1 1.4-2.1 2.9V21h-4V9z"/>
                            </svg>
                        </a>

                        <a href="#" class="text-gray-500 hover:text-white transition" aria-label="Twitter">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path d="M18.9 2H22l-6.8 7.8 8 12.2h-6.3l-4.9-7.4L6.4 22H3.3l7.3-8.4L3 2h6.4l4.5 6.8L18.9 2zm-1.1 18h1.7L8.5 3.9H6.7L17.8 20z"/>
                            </svg>
                        </a>
                    </div>
                </div>

                {{-- Office --}}
                <div>
                    <h4 class="font-semibold mb-5 uppercase text-xs tracking-[0.25em] text-blue-400">
                        Our Office
                    </h4>

                    <div class="rounded-3xl overflow-hidden border border-gray-800 shadow-2xl">
                        <iframe
                            src="https://www.google.com/maps?q=бул.%20Витоша%2089B,%20София&output=embed"
                            width="100%"
                            height="200"
                            style="border:0;"
                            allowfullscreen=""
                            loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>

                {{-- Quick Links --}}
                <div>
                    <h4 class="font-semibold mb-5 uppercase text-xs tracking-[0.25em] text-blue-400">
                        Quick Links
                    </h4>

                    <ul class="space-y-4 text-sm">
                        <li>
                            <a href="{{ route('about-us.index') }}"
                               class="text-gray-400 hover:text-white transition duration-300">
                                About Us
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('contact-us.index') }}"
                               class="text-gray-400 hover:text-white transition duration-300">
                                Contact Us
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('privacy') }}"
                               class="text-gray-400 hover:text-white transition duration-300">
                                Privacy Policy
                            </a>
                        </li>

                        <li>
                            <a href="#"
                               class="text-gray-400 hover:text-white transition duration-300">
                                Terms & Conditions
                            </a>
                        </li>
                    </ul>
                </div>

                {{-- Contact --}}
                <div>
                    <h4 class="font-semibold mb-5 uppercase text-xs tracking-[0.25em] text-blue-400">
                        Contact
                    </h4>

                    <div class="space-y-5 text-sm text-gray-400">

                        <div class="flex items-start gap-3">
                            <i class="fas fa-location-dot text-blue-400 mt-1"></i>
                            <span>Sofia, Blvd Vitosha 123</span>
                        </div>

                        <div class="flex items-start gap-3">
                            <i class="fas fa-envelope text-blue-400 mt-1"></i>
                            <span>support@realestate.bg</span>
                        </div>

                        <div class="flex items-start gap-3">
                            <i class="fas fa-phone text-blue-400 mt-1"></i>
                            <span>+359 888 123 456</span>
                        </div>

                    </div>

                    {{-- Newsletter --}}
                    <div class="mt-8">
                        <p class="text-xs uppercase tracking-[0.2em] text-gray-500 mb-3">
                            Join Newsletter
                        </p>

                        <div class="flex overflow-hidden rounded-2xl border border-gray-800 bg-gray-900">
                            <input type="email"
                                   placeholder="Your email"
                                   class="w-full bg-transparent px-4 py-3 text-sm text-white placeholder-gray-500 focus:outline-none">

                            <button class="bg-blue-600 hover:bg-blue-500 px-5 transition">
                                <i class="fas fa-arrow-right"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Bottom --}}
            <div class="mt-16 pt-8 border-t border-gray-900 flex flex-col md:flex-row items-center justify-between gap-4">
                <p class="text-xs text-gray-600 text-center md:text-left">
                    &copy; 2026 RealEstate Platform. All rights reserved.
                </p>

                <p class="text-xs text-gray-700">
                    Designed with modern real estate aesthetics.
                </p>
            </div>
        </div>
    </footer>
</html>
