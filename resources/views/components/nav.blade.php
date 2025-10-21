<nav class="sticky top-0 z-50 bg-white/30 backdrop-blur border-b">
        <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="/" class="font-bold tracking-tight text-lg">Spidy company</a>

            <nav class="flex items-center gap-6 text-sm">
                <a href="/#welcome" class="hover:text-pink-600">Welcome</a>
                <a href="/#group" class="hover:text-pink-600">The Group</a>
                <a href="/#about" class="hover:text-pink-600">About</a>
                <a href="/activities" class="hover:text-pink-600">Activities</a>
            </nav>

            {{-- Right-side user/auth section --}}
            <div class="flex items-center gap-4">
                @guest
                    <a href="{{ route('login') }}" class="btn-brand-outline">
                        Login
                    </a>
                    <a href="{{ route('register') }}" class="btn-brand-solid">
                        Register
                    </a>
                @endguest

                @auth
                    <div x-data="{ open: false }" class="relative">
                        <button @click="open = !open" class="flex items-center space-x-2 focus:outline-none">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}" 
                                alt="Profile" class="w-8 h-8 rounded-full border">
                            <span>{{ Auth::user()->name }}</span>
                        </button>

                        <div x-show="open" @click.away="open = false"
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
        </div>
    </nav>