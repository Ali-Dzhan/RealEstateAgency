<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Real Estate Agency</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

<!-- Navbar -->
<nav class="bg-white shadow-md p-4">
    <div class="container mx-auto flex justify-between items-center">
        <a href="/" class="font-bold text-xl text-blue-600">Real Estate Agency</a>
        <ul class="flex space-x-4">
            <li><a href="{{ url('/properties') }}" class="hover:text-blue-500">Properties</a></li>
            <li><a href="{{ url('/agents') }}" class="hover:text-blue-500">Agents</a></li>
            <li><a href="{{ url('/clients') }}" class="hover:text-blue-500">Clients</a></li>
            <li><a href="{{ url('/viewings') }}" class="hover:text-blue-500">Viewings</a></li>
            <li><a href="{{ url('/offers') }}" class="hover:text-blue-500">Offers</a></li>
        </ul>
    </div>
</nav>

<!-- Main content -->
<div class="container mx-auto mt-8">
    @yield('content')
</div>

</body>
</html>
