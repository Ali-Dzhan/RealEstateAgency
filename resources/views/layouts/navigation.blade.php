<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-xl font-bold text-blue-600">🏠 RealEstate</a>

        <!-- Links -->
        <div class="space-x-4">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Home</a>

            @auth
                <a href="{{ route('profile.edit') }}" class="hover:text-blue-600">Profile</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="hover:text-blue-600">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="hover:text-blue-600">Login</a>
                <a href="{{ route('register') }}" class="hover:text-blue-600">Register</a>
            @endauth
        </div>
    </div>
</nav>
