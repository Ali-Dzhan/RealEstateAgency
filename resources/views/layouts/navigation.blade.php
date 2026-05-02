<nav class="bg-white shadow sticky top-0 z-50" x-data="{ mobileMenu: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <a href="{{ route('home') }}" class="flex items-center text-2xl font-bold text-blue-700">
                🏠 <span class="ml-1">RealEstate</span>
            </a>

            <div class="hidden md:flex items-center space-x-6 font-medium text-gray-700">
                <a href="{{ route('home') }}" class="hover:text-blue-700 transition">Home</a>
                <a href="{{ route('properties.index') }}" class="hover:text-blue-700 transition">Properties</a>
                <a href="{{ route('about-us.index') }}" class="hover:text-blue-700 transition">About Us</a>
                <a href="{{ route('contact-us.index') }}" class="hover:text-blue-700 transition">Contact</a>

                @auth
                    <a href="{{ route('profile.edit') }}" class="hover:text-blue-700 transition">Profile</a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button class="text-red-600 hover:text-red-700">Logout</button>
                    </form>
                @else
                    <a href="{{ route('auth') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition">Login</a>
                @endauth
            </div>

            <button @click="mobileMenu = !mobileMenu"
                    class="md:hidden text-gray-700 text-2xl focus:outline-none">
                <i class="fa-solid" :class="mobileMenu ? 'fa-xmark' : 'fa-bars'"></i>
            </button>
        </div>

        <div x-show="mobileMenu"
             x-transition
             class="md:hidden border-t bg-white py-4 space-y-3 font-medium text-gray-700">

            <a href="{{ route('home') }}" class="block px-2 py-2 hover:text-blue-700">Home</a>
            <a href="{{ route('properties.index') }}" class="block px-2 py-2 hover:text-blue-700">Properties</a>
            <a href="{{ route('about-us.index') }}" class="block px-2 py-2 hover:text-blue-700">About Us</a>
            <a href="{{ route('contact-us.index') }}" class="block px-2 py-2 hover:text-blue-700">Contact</a>

            @auth
                <a href="{{ route('profile.edit') }}" class="block px-2 py-2 hover:text-blue-700">Profile</a>
                <a href="{{ route('viewings.index') }}" class="block px-2 py-2 hover:text-blue-700">Viewings</a>
                <a href="{{ route('offers.index') }}" class="block px-2 py-2 hover:text-blue-700">Offers</a>

                @if(auth()->user()->role === 'agent')
                    <a href="{{ route('offers.create') }}" class="block px-2 py-2 text-blue-700 font-semibold">+ Offer</a>
                @endif

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('agents.index') }}" class="block px-2 py-2 hover:text-blue-700">Agents</a>
                    <a href="{{ route('clients.index') }}" class="block px-2 py-2 hover:text-blue-700">Clients</a>
                    <a href="{{ route('audit_logs.index') }}" class="block px-2 py-2 hover:text-blue-700">Audit Logs</a>
                    <a href="{{ route('messages.index') }}" class="block px-2 py-2 hover:text-blue-700">Client Inquiries</a>
                    <a href="{{ route('reports.index') }}" class="block px-2 py-2 hover:text-blue-700">Reports</a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="block w-full text-left px-2 py-2 text-red-600 font-semibold">
                        Logout
                    </button>
                </form>
            @else
                <a href="{{ route('auth') }}" class="block mx-2 bg-blue-600 text-white px-4 py-2 rounded-lg text-center">
                    Login
                </a>
            @endauth
        </div>
    </div>
</nav>
