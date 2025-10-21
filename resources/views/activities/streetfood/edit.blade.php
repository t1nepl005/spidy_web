<x-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Edit Street Food Item</h1>

        <form action="{{ route('streetfood.update', $streetFood->id) }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            @include('activities.streetfood._form', ['streetFood' => $streetFood])
            
            <div class="flex justify-between items-center">
                <a href="{{ route('streetfood.index') }}"
                    class="text-gray-600 hover:text-gray-800 underline">
                    ← Back to List
                </a>

                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</x-layout>
