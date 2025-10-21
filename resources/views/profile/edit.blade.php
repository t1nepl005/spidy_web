<x-layout :wrapped="false">
    <div class="flex justify-center items-center min-h-[70vh]">
        <div class="w-[90vw] md:w-130 m-auto bg translucent-bg">
            <h2 class="text-xl font-semibold mb-4">Edit Profile</h2>

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-2 rounded mb-3">{{ session('success') }}</div>
            @endif

            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                <div class="mb-4">
                    <label class="block text-sm font-bold mb-1">Name</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" 
                        class="input" required>
                    @error('name') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold mb-1">Username</label>
                    <input type="text" name="username" value="{{ old('username', $user->username) }}" 
                        class="input" required>
                    @error('username') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="mb-4">
                    <label class="block text-sm font-bold mb-1">Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" 
                        class="input" required>
                    @error('email') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <div class="flex justify-between items-center">
                    <button type="submit" class="bg-pink-500 text-white py-2 px-4 rounded hover:bg-pink-600">
                        Save Changes
                    </button>
                    <a href="{{ route('profile.password') }}" class="text-sm text-pink-700 hover:underline">
                        Change Password
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-layout>
