<nav class="bg-white shadow sticky top-0 z-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center text-2xl font-bold text-blue-700">
                🏠 <span class="ml-1">RealEstate</span>
            </a>

            <!-- Main Navigation -->
            <div class="hidden md:flex items-center space-x-6 font-medium text-gray-700">
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('agents.index') }}" class="hover:text-blue-700 hover:border-b-2 border-blue-600 pb-1 transition">Agents</a>
                    <a href="{{ route('clients.index') }}" class="hover:text-blue-700 hover:border-b-2 border-blue-600 pb-1 transition">Clients</a>
                    <a href="{{ route('audit_logs.index') }}" class="hover:text-blue-700 hover:border-b-2 border-blue-600 pb-1 transition">Audit Logs</a>
                @endif

                <a href="{{ route('properties.index') }}" class="hover:text-blue-700 hover:border-b-2 border-blue-600 pb-1 transition">Properties</a>

                @auth
                    <a href="{{ route('viewings.index') }}" class="hover:text-blue-700 hover:border-b-2 border-blue-600 pb-1 transition">Viewings</a>
                    <a href="{{ route('offers.index') }}" class="hover:text-blue-700 hover:border-b-2 border-blue-600 pb-1 transition">Offers</a>
                    <a href="{{ route('profile.edit') }}" class="hover:text-blue-700 hover:border-b-2 border-blue-600 pb-1 transition">Profile</a>

                    @if(auth()->user()->role === 'agent')
                        <a href="{{ route('offers.create') }}" class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 transition">+ New Offer</a>
                    @endif

                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-700 font-semibold ml-4 flex items-center">
                            <i class="fa-solid fa-right-from-bracket mr-1"></i> Logout
                        </button>
                    </form>
                @else
                    <a href="{{ route('auth') }}" class="bg-blue-600 text-white px-4 py-1.5 rounded-lg hover:bg-blue-700 transition">Login / Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
