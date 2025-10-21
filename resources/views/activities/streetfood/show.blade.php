<x-layout>
    <div class="max-w-2xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
        <h1 class="text-3xl font-semibold text-gray-800 mb-4">{{ $streetFood->food_name }}</h1>

        @if($streetFood->image)
            <img src="{{ $streetFood->image }}" alt="{{ $streetFood->food_name }}"
                class="w-full h-64 object-cover rounded-lg mb-4">
        @endif

        <p class="text-gray-700 mb-3"><strong>Description:</strong> {{ $streetFood->description }}</p>
        <p class="text-gray-700 mb-6"><strong>Price:</strong> ${{ number_format($streetFood->price, 2) }}</p>

        <div class="flex justify-between">
            <a href="{{ route('streetfood.index') }}"
                class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">
                ← Back
            </a>

            <div class="space-x-2">
                <a href="{{ route('streetfood.edit', $streetFood->id) }}"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Edit
                </a>
                <form action="{{ route('streetfood.destroy', $streetFood->id) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition"
                        onclick="return confirm('Are you sure?')">
                        Delete
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
