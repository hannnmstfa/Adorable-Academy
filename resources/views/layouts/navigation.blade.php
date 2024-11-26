<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <!-- Primary Navigation Menu -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <!-- Logo -->
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('home') }}">
                        <x-application-logo class="block h-9 w-auto fill-current text-gray-800" />
                    </a>
                </div>

                <!-- Navigation Links -->
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                        {{ __('Beranda') }}
                    </x-nav-link>
                    <x-nav-link :href="route('kelas.index')" :active="request()->routeIs('kelas.index')">
                        {{ __('Kelas') }}
                    </x-nav-link>
                    <x-nav-link :href="route('testimoni')" :active="request()->routeIs('testimoni')">
                        {{ __('Testimoni') }}
                    </x-nav-link>
                    <x-nav-link :href="route('tutorial')" :active="request()->routeIs('tutorial')">
                        {{ __('Tutorial') }}
                    </x-nav-link>
                    <x-nav-link :href="route('kemitraan')" :active="request()->routeIs('kemitraan')">
                        {{ __('Kemitraan') }}
                    </x-nav-link>
                    <x-nav-link :href="route('affiliate')" :active="request()->routeIs('affiliate')">
                        {{ __('Affiliate') }}
                    </x-nav-link>
                </div>
            </div>

            <!-- Hamburger Menu for mobile -->
            <div class="-mr-2 flex items-center sm:hidden">
                <button @click="open = !open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none transition duration-150 ease-in-out">
                    <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                        <path :class="{'hidden': open, 'inline-flex': !open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                        <path :class="{'hidden': !open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Conditional Navigation based on Authentication -->
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                @auth
                <a href="" class="mr-5">
                    <i class="fa-brands fa-2x fa-whatsapp"></i>
                </a>
                <a align='right' class="mr-5" href="{{route('keranjang')}}">
                    <i class="fa-solid fa-cart-shopping fa-2x"></i>
                </a>
                <!-- Settings Dropdown -->
                <x-dropdown align="right" width="48">
                    <x-slot name="trigger">
                        <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                            <div><i class="fas fa-user text-primary"></i> {{ Auth::user()->name }}</div>

                            <div class="ms-1">
                                <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <x-dropdown-link :href="route('profile.edit')">
                            {{ __('Profile') }}
                        </x-dropdown-link>
                        @if(Auth::user()->role == 'superadmin')
                        <x-dropdown-link :href="route('usersmanage.index')">
                            {{ __('Manajemen Pengguna') }}
                        </x-dropdown-link>
                        <x-dropdown-link :href="route('transaksi.index')">
                            {{ __('Daftar Transaksi') }}
                        </x-dropdown-link>
                        <form action="callback" method="post">
                            @csrf
                            <button type="submit">callback</button>
                        </form>
                        @endif

                        <!-- Authentication -->
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ __('Log Out') }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
                @endauth

                @guest
                <!-- Login/Register Links (shown when user is not authenticated) -->
                <div class="space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                        {{ __('Login / Register') }}
                    </x-nav-link>
                </div>
                @endguest
            </div>
        </div>
    </div>

    <!-- Mobile Navigation Menu -->
    <div :class="{'block': open, 'hidden': !open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                {{ __('Beranda') }}
            </x-nav-link>
            <x-nav-link :href="route('kelas.index')" :active="request()->routeIs('kelas.index')">
                {{ __('Kelas') }}
            </x-nav-link>
            <x-nav-link :href="route('testimoni')" :active="request()->routeIs('testimoni')">
                {{ __('Testimoni') }}
            </x-nav-link>
            <x-nav-link :href="route('tutorial')" :active="request()->routeIs('tutorial')">
                {{ __('Tutorial') }}
            </x-nav-link>
            <x-nav-link :href="route('kemitraan')" :active="request()->routeIs('kemitraan')">
                {{ __('Kemitraan') }}
            </x-nav-link>
            <x-nav-link :href="route('affiliate')" :active="request()->routeIs('affiliate')">
                {{ __('Affiliate') }}
            </x-nav-link>
        </div>

        <!-- Mobile Profile Dropdown Menu -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                @auth
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
                @endauth
            </div>

            <div class="mt-3 space-y-1">
                @auth
                <x-dropdown-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-dropdown-link>
                @if(Auth::user()->role == 'superadmin')
                <x-dropdown-link :href="route('usersmanage.index')">
                    {{ __('Manajemen Pengguna') }}
                </x-dropdown-link>
                <x-dropdown-link :href="route('transaksi.index')">
                    {{ __('Daftar Transaksi') }}
                </x-dropdown-link>
                @endif

                <!-- Logout -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <x-dropdown-link :href="route('logout')" onclick="event.preventDefault(); this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-dropdown-link>
                </form>
                @endauth

                @guest
                <x-dropdown-link :href="route('login')">
                    {{ __('Login / Register') }}
                </x-dropdown-link>
                @endguest
            </div>
        </div>
    </div>
</nav>
