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
                    <div x-data="{ open: false }" class="relative">
                        <button
                            @click="open = !open"
                            class="flex items-center gap-2 text-gray-700 font-medium hover:text-blue-700 focus:outline-none">
                            <span>Admin Panel</span>
                            <i
                                class="fa-solid fa-chevron-down text-sm transition-transform duration-300"
                                :class="{ 'rotate-180': open }">
                            </i>
                        </button>

                        <div
                            x-show="open"
                            x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-1"
                            x-transition:enter-end="opacity-100 translate-y-0"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0"
                            x-transition:leave-end="opacity-0 translate-y-1"
                            @click.outside="open = false"
                            class="absolute left-0 mt-2 w-44 bg-white border border-gray-200 rounded-md shadow-lg z-50"
                        >
                            <a href="{{ route('agents.index') }}"
                               class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">Agents</a>
                            <a href="{{ route('clients.index') }}"
                               class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">Clients</a>
                            <a href="{{ route('audit_logs.index') }}"
                               class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">Audit Logs</a>
                            <a href="{{ route('reports.index') }}"
                               class="block px-4 py-2 text-gray-700 hover:bg-blue-50 hover:text-blue-700 transition">Reports</a>
                        </div>
                    </div>
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
