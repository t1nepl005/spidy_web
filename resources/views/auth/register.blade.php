<x-layout :wrapped="false">
    <div class="flex justify-center align-center min-h-[70vh] m-5">
        <div class="w-[90vw] md:w-130 m-auto bg translucent-bg">
            <form class="rounded px-8 pt-6 pb-8" method="POST" action="{{ route('register') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-800 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input class="input" id="name" type="text" name="name" value="{{ old('name') }}" required autofocus>
                    @error('name')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-800 text-sm font-bold mb-2" for="username">
                        Username
                    </label>
                    <input class="input" id="username" type="text" name="username" value="{{ old('username') }}" required>
                    @error('username')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-800 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input class="input" id="email" type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-4">
                    <label class="block text-gray-800 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="input" id="password" type="password" name="password" required>
                    @error('password')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block text-gray-800 text-sm font-bold mb-2" for="password_confirmation">
                        Confirm Password
                    </label>
                    <input class="input" id="password_confirmation" type="password" name="password_confirmation" required>
                </div>
                <div class="flex items-center justify-between">
                    <button class="btn-brand-solid !px-5 !py-2" type="submit">
                        Register
                    </button>
                    <a class="text-pink-800 hover:underline" href="{{ route('login') }}">
                        Already have an account?
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
