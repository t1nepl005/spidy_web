<x-layout>
    <div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded-xl shadow-md">
        <h1 class="text-2xl font-semibold text-gray-800 mb-6">Create Street Food Item</h1>

        <form action="{{ route('streetfood.store') }}" method="POST" class="space-y-6">
            @csrf
            @include('activities.streetfood._form')
            
            <div class="flex justify-end">
                <button type="submit"
                    class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                    Create
                </button>
            </div>
        </form>
    </div>
</x-layout>
