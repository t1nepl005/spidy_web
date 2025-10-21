<x-layout :wrapped="false">
    <div class="flex justify-center items-center min-h-[70vh]">
        <div class="w-[90vw] md:w-130 m-auto bg translucent-bg">
            <form class="rounded px-8 pt-6 pb-8" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-black-800 text-sm font-bold mb-2" for="email">
                        Email or Username
                    </label>
                    <input class="input" id="email" type="text" name="email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <p class="text-pink-800 text-xs italic mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
                <div class="mb-6">
                    <label class="block text-gray-800 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <input class="input" id="password" type="password" name="password" required>
                    @error('password')
                        <p class="text-pink-800 text-xs italic mt-1.5">{{ $message }}</p>
                    @enderror
                </div>
                <div class="flex items-center justify-between">
                    <button class="btn-brand-solid !px-5 !py-2" type="submit">
                        Sign In
                    </button>
                    <a class=" text-pink-800 hover:underline" href="{{ route('register') }}">
                        Create an Account
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
