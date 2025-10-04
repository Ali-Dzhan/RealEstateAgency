<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Real Estate') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <link rel="icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" sizes="32x32">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon" sizes="32x32">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased">
<div class="min-h-screen bg-gray-100">
    <!-- Navigation -->
    @include('layouts.navigation')

    <!-- Page Content -->
    <main class="max-w-md mx-auto py-12 px-6 sm:px-8 lg:px-10">
        <div class="bg-white shadow-md sm:rounded-lg p-6">
            @yield('content')
        </div>
    </main>
</div>
</body>
</html>
