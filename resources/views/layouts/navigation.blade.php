<nav x-data="{ open: false }" class="bg-[#1a1d24] border-b border-[#2a2d36]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">
            <!-- Branding -->
            <div class="flex items-center">
                <a href="{{ route('dashboard') }}" class="text-2xl font-bold text-white">
                    Vira<span class="text-green-400">Link</span>
                </a>
            </div>

            <!-- Desktop Links -->
            <div class="hidden sm:flex items-center space-x-6">
                <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                    Dashboard
                </x-nav-link>

                <x-nav-link :href="route('hashtags.form')" :active="request()->routeIs('hashtags.form')">
                    Hashtag Generator
                </x-nav-link>

                <x-nav-link :href="route('history')" :active="request()->routeIs('history')">
                    History
                </x-nav-link>
            </div>

            <!-- Settings Dropdown -->
            <div class="hidden sm:flex sm:items-center">
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm font-medium rounded-md text-gray-300 hover:text-white focus:outline-none transition">
                            <div>{{ Auth::user()->name }}</div>
                            <svg class="ml-1 h-4 w-4 fill-current" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0L5.293 8.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            Profile
                        </x-dropdown-link>

                        <!-- Logout -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                Log Out
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>

            <!-- Hamburger for Mobile -->
            <div class="-mr-2 flex sm:hidden">
                <button @click="open = ! open" class="p-2 rounded-md text-gray-400 hover:text-white focus:outline-none transition">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24">
                        <path :class="{ 'hidden': open, 'inline-flex': !open }" class="inline-flex"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M4 6h16M4 12h16M4 18h16" />
                        <path :class="{ 'hidden': !open, 'inline-flex': open }" class="hidden"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>
    </div>

    <!-- Mobile Navigation -->
    <div :class="{ 'block': open, 'hidden': !open }" class="sm:hidden hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                Dashboard
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('hashtags.form')" :active="request()->routeIs('hashtags.form')">
                Hashtag Generator
            </x-responsive-nav-link>
            <x-responsive-nav-link :href="route('history')" :active="request()->routeIs('history')">
                History
            </x-responsive-nav-link>
        </div>

        <!-- Mobile Settings -->
        <div class="pt-4 pb-1 border-t border-gray-600">
            <div class="px-4">
                <div class="text-white font-semibold text-base">{{ Auth::user()->name }}</div>
                <div class="text-sm text-gray-400">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    Profile
                </x-responsive-nav-link>

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-responsive-nav-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        Log Out
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
