<x-layout :wrapped="false">
    <div class="flex justify-center items-center min-h-[70vh]">
        <div class="w-[90vw] md:w-130 m-auto bg translucent-bg">
            <h2 class="text-xl font-semibold mb-4">Change Password</h2>

            @if(session('success'))
                <x-alert-block> {{ session('success') }}</x-alert-block>
            @endif


            <form method="POST" action="{{ route('profile.password.update') }}">
                @csrf

                <div class="mb-4">
                    <label class="block text-sm font-bold mb-1">Current Password</label>
                    <input type="password" name="current_password" class="bg-white/30 border border-white/20 focus:border-pink-400 focus:ring-1 focus:ring-pink-300 rounded w-full py-2 px-3 outline-none transition duration-200" required>
                    @error('current_password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold mb-1">New Password</label>
                    <input type="password" name="password" class="bg-white/30 border border-white/20 focus:border-pink-400 focus:ring-1 focus:ring-pink-300 rounded w-full py-2 px-3 outline-none transition duration-200" required>
                    @error('password') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold mb-1">Confirm New Password</label>
                    <input type="password" name="password_confirmation" class="bg-white/30 border border-white/20 focus:border-pink-400 focus:ring-1 focus:ring-pink-300 rounded w-full py-2 px-3 outline-none transition duration-200" required>
                </div>

                <button type="submit" class="bg-pink-500 text-white py-2 px-4 rounded hover:bg-pink-600">
                    Update Password
                </button>
            </form>
        </div>
    </div>
</x-layout>
