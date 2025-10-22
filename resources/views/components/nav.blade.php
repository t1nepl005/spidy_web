<nav x-data="{ open: false, userMenu: false }" class="sticky top-0 z-50 bg-white/30 backdrop-blur border-b">
    <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
        <!-- Brand -->
        <a href="/" class="font-bold tracking-tight text-lg">Spidy company</a>

        <!-- Desktop Links -->
        <nav class="hidden md:flex items-center gap-6 text-sm">
            <a href="/#welcome" class="hover:text-pink-600">Welcome</a>
            <a href="/#group" class="hover:text-pink-600">The Group</a>
            <a href="/#about" class="hover:text-pink-600">About</a>
            <a href="/activities" class="hover:text-pink-600">Activities</a>
        </nav>

        <!-- Right-side (Login/Register or Profile) -->
        <div class="hidden md:flex items-center gap-4">
            @guest
                <a href="{{ route('login') }}" class="btn-brand-outline">Login</a>
                <a href="{{ route('register') }}" class="btn-brand-solid">Register</a>
            @endguest

            @auth
                <div class="relative" x-data="{ userMenu: false }">
                    <button @click="userMenu = !userMenu" class="flex items-center space-x-2 focus:outline-none">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" 
                             alt="Profile" class="w-8 h-8 rounded-full border">
                        <span>{{ Auth::user()->name }}</span>
                    </button>

                    <!-- User dropdown -->
                    <div x-show="userMenu" @click.away="userMenu = false"
                        x-transition
                        class="absolute right-0 mt-2 w-40 bg-white rounded-lg shadow-lg border">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2 hover:bg-gray-100">Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">Logout</button>
                        </form>
                    </div>
                </div>
            @endauth
        </div>

        <!-- Mobile Hamburger -->
        <button 
            @click="open = !open" 
            class="md:hidden p-2 rounded focus:outline-none focus:ring-2 focus:ring-pink-500"
            aria-label="Toggle Menu"
        >
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M4 6h16M4 12h16M4 18h16" />
            </svg>
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
    </div>

    <!-- Mobile Menu -->
    <div 
        x-show="open" 
        @click.away="open = false"
        x-transition
        class="md:hidden bg-white/90 backdrop-blur-md border-t"
    >
        <div class="px-4 py-3 flex flex-col space-y-3 text-sm">
            <a href="/#welcome" class="hover:text-pink-600">Welcome</a>
            <a href="/#group" class="hover:text-pink-600">The Group</a>
            <a href="/#about" class="hover:text-pink-600">About</a>
            <a href="/activities" class="hover:text-pink-600">Activities</a>

            <hr class="border-gray-200 my-2">

            @guest
                <a href="{{ route('login') }}" class="btn-brand-outline w-full text-center">Login</a>
                <a href="{{ route('register') }}" class="btn-brand-solid w-full text-center">Register</a>
            @endguest

            @auth
                <div class="flex items-center space-x-3">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" 
                         alt="Profile" class="w-8 h-8 rounded-full border">
                    <span class="font-medium">{{ Auth::user()->name }}</span>
                </div>
                <div class="flex flex-col mt-2 space-y-1">
                    <a href="{{ route('profile.edit') }}" class="hover:text-pink-600">Profile</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-left hover:text-pink-600">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </div>
</nav>
