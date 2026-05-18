<nav class="bg-white shadow sticky top-0 z-50" x-data="{ mobileMenu: false }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between items-center h-16">

            <a href="{{ route('home') }}" class="flex items-center text-2xl font-bold text-blue-700">
                <img src="{{ asset('images/real_estate_logo_transparent.png') }}"
                     alt="Real Estate Logo"
                     class="h-10 w-auto">
            </a>

            {{-- Desktop Menu --}}
            <div class="hidden md:flex items-center space-x-6 font-medium text-gray-700">

                <a href="{{ route('home') }}" class="hover:text-blue-700 transition">Home</a>
                <a href="{{ route('properties.index') }}" class="hover:text-blue-700 transition">Properties</a>
                <a href="{{ route('about-us.index') }}" class="hover:text-blue-700 transition">About Us</a>
                <a href="{{ route('contact-us.index') }}" class="hover:text-blue-700 transition">Contact</a>

                {{-- Admin Dropdown --}}
                @if(auth()->check() && auth()->user()->role === 'admin')
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open"
                                class="flex items-center gap-1 hover:text-blue-700">
                            <span>Admin</span>
                            <i class="fa-solid fa-chevron-down text-xs"
                               :class="{ 'rotate-180': open }"></i>
                        </button>

                        <div x-show="open"
                             @click.outside="open = false"
                             x-transition
                             class="absolute right-0 mt-2 w-52 bg-white border rounded-lg shadow-lg py-2 z-50">

                            <a href="{{ route('agents.index') }}" class="block px-4 py-2 hover:bg-gray-100">Agents</a>
                            <a href="{{ route('clients.index') }}" class="block px-4 py-2 hover:bg-gray-100">Clients</a>
                            <a href="{{ route('audit_logs.index') }}" class="block px-4 py-2 hover:bg-gray-100">Audit Logs</a>
                            <a href="{{ route('messages.index') }}" class="block px-4 py-2 hover:bg-gray-100">Client Inquiries</a>
                            <a href="{{ route('reports.index') }}" class="block px-4 py-2 hover:bg-gray-100">Reports</a>
                        </div>
                    </div>
                @endif

                @auth

                    @if(auth()->user()->role === 'agent')
                        <a href="{{ route('offers.create') }}"
                           class="bg-blue-600 text-white px-3 py-1 rounded-lg hover:bg-blue-700 text-sm">
                            + Offer
                        </a>
                    @endif

                    {{-- Account Dropdown --}}
                    <div x-data="{ open: false }" class="relative">

                        <button @click="open = !open"
                                class="flex items-center gap-2 bg-gray-100 px-3 py-2 rounded-full hover:text-blue-700">

                            <i class="fa-solid fa-circle-user text-xl"></i>

                            <span class="text-sm font-semibold">
                                {{ auth()->user()->first_name ?? 'Account' }}
                            </span>

                            <i class="fa-solid fa-chevron-down text-xs"
                               :class="{ 'rotate-180': open }"></i>
                        </button>

                        <div x-show="open"
                             @click.outside="open = false"
                             x-transition
                             class="absolute right-0 mt-2 w-52 bg-white border rounded-lg shadow-lg py-2 text-sm z-50">

                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-2 hover:bg-gray-100">
                                <i class="fa-solid fa-user mr-2"></i> Profile
                            </a>

                            <a href="{{ route('viewings.index') }}"
                               class="block px-4 py-2 hover:bg-gray-100">
                                <i class="fa-solid fa-calendar-check mr-2"></i> Viewings
                            </a>

                            <a href="{{ route('offers.index') }}"
                               class="block px-4 py-2 hover:bg-gray-100">
                                <i class="fa-solid fa-hand-holding-dollar mr-2"></i> Offers
                            </a>

                            <hr class="my-1">

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-4 py-2 text-red-600 hover:bg-red-50 font-semibold">
                                    <i class="fa-solid fa-right-from-bracket mr-2"></i> Logout
                                </button>
                            </form>

                        </div>
                    </div>

                @else

                    <a href="{{ route('auth') }}"
                       class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                        Login
                    </a>

                @endauth

            </div>

            {{-- Mobile Burger --}}
            <button @click="mobileMenu = !mobileMenu"
                    class="md:hidden text-2xl text-gray-700">
                <i class="fa-solid" :class="mobileMenu ? 'fa-xmark' : 'fa-bars'"></i>
            </button>

        </div>

        {{-- Mobile Menu --}}
        <div x-show="mobileMenu"
             x-transition
             class="md:hidden border-t py-4 space-y-2">

            <a href="{{ route('home') }}" class="block py-2">Home</a>
            <a href="{{ route('properties.index') }}" class="block py-2">Properties</a>
            <a href="{{ route('about-us.index') }}" class="block py-2">About Us</a>
            <a href="{{ route('contact-us.index') }}" class="block py-2">Contact</a>

            @auth
                <a href="{{ route('profile.edit') }}" class="block py-2">Profile</a>
                <a href="{{ route('viewings.index') }}" class="block py-2">Viewings</a>
                <a href="{{ route('offers.index') }}" class="block py-2">Offers</a>

                @if(auth()->user()->role === 'admin')
                    <a href="{{ route('agents.index') }}" class="block py-2">Agents</a>
                    <a href="{{ route('clients.index') }}" class="block py-2">Clients</a>
                    <a href="{{ route('reports.index') }}" class="block py-2">Reports</a>
                @endif

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="block py-2 text-red-600">Logout</button>
                </form>
            @else
                <a href="{{ route('auth') }}"
                   class="block bg-blue-600 text-white px-4 py-2 rounded-lg text-center">
                    Login
                </a>
            @endauth

        </div>

    </div>
</nav>
