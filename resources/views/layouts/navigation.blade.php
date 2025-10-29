<nav class="bg-white shadow">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center h-16">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="text-xl font-bold text-blue-700">🏠 RealEstate</a>

        <!-- Links -->
        <div class="space-x-4">

            @auth
            @if(auth()->user()->role === 'agent')
                <a href="{{ route('offers.create') }}" class="relative pb-1.5 border-b-4 border-transparent
                 hover:border-blue-600 transition-all duration-300">+ New Offer</a>
            @endif
            @endauth

            <a href="{{ route('properties.index') }}" class="relative pb-1.5 border-b-4 border-transparent
             hover:border-blue-600 transition-all duration-300">Properties</a>

            @auth
                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('agents.index') }}" class="relative pb-1.5 border-b-4 border-transparent
                 hover:border-blue-600 transition-all duration-300">Agents</a>
                    <a href="{{ route('clients.index') }}" class="relative pb-1.5 border-b-4 border-transparent
                 hover:border-blue-600 transition-all duration-300">Clients</a>
                @endif

                <a href="{{ route('viewings.index') }}" class="relative pb-1.5 border-b-4 border-transparent
                 hover:border-blue-600 transition-all duration-300">Viewings</a>
                <a href="{{ route('offers.index') }}" class="relative pb-1.5 border-b-4 border-transparent
                 hover:border-blue-600 transition-all duration-300">Offers</a>
                <a href="{{ route('profile.edit') }}" class="relative pb-1.5 border-b-4 border-transparent
                 hover:border-blue-600 transition-all duration-300">Profile</a>

                <form method="POST" action="{{ route('logout') }}" class="inline">
                    @csrf
                    <button type="submit" class="relative pb-1.5 border-b-4 border-transparent
                     hover:border-blue-600 transition-all duration-300 font-extrabold">
                        <i class="fa-solid fa-right-from-bracket"></i>
{{--                        Logout--}}
                    </button>
                </form>
            @else
                <a href="{{ route('auth') }}" class="relative pb-1.5 border-b-4 border-transparent
                 hover:border-blue-600 transition-all duration-300">Login | Register</a>
            @endauth
        </div>
    </div>
</nav>
