<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Real Estate') }}</title>

        <!-- Font Awesome Icons -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@6.5.2/css/all.min.css">

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

    <footer class="bg-gray-900 text-white py-12">
        <div class="max-w-7xl mx-auto px-6 grid md:grid-cols-3 gap-12 border-t border-gray-800 pt-12">
            <div>
                <h3 class="text-xl font-bold mb-4">🏠 RealEstate</h3>
                <p class="text-gray-400 text-sm">The leading property platform in Bulgaria. Find your home, build your future.</p>
            </div>
            <div>
                <h4 class="font-bold mb-4 uppercase text-xs tracking-widest text-blue-500">Links</h4>
                <ul class="space-y-2 text-sm text-gray-400">
                    <li><a href="{{ route('about-us.index') }}" class="hover:text-white transition">About Us</a></li>
                    <li><a href="{{ route('contact-us.index') }}" class="hover:text-white transition">Contact Us</a></li>
                    <li><a href="{{ route('privacy') }}" class="hover:text-white transition">Privacy Policy</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-4 uppercase text-xs tracking-widest text-blue-500">Contact</h4>
                <p class="text-sm text-gray-400">Sofia, Blvd Vitosha 123</p>
                <p class="text-sm text-gray-400 mt-2">support@realestate.bg</p>
            </div>
        </div>
        <div class="text-center mt-12 text-gray-600 text-xs">
            &copy; 2026 RealEstate Platform. All rights reserved.
        </div>
    </footer>
</html>
