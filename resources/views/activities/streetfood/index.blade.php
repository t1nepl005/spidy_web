<x-layout>
    <div class="container mx-auto px-4 mt-10">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-2xl font-semibold text-gray-800">Street Food Items</h1>
            <a href="{{ route('streetfood.create') }}"
                class="px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition">
                + Add New
            </a>
        </div>

        <div class="overflow-x-auto bg-white rounded-lg shadow">
            <table class="min-w-full table-auto border-collapse">
                <thead class="bg-gray-100 text-gray-700">
                    <tr>
                        <th class="px-4 py-2 text-left">Name</th>
                        <th class="px-4 py-2 text-left">Description</th>
                        <th class="px-4 py-2 text-left">Price</th>
                        <th class="px-4 py-2 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($streetFoods as $streetFood)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $streetFood->food_name }}</td>
                            <td class="px-4 py-2 text-gray-600">{{ Str::limit($streetFood->description, 50) }}</td>
                            <td class="px-4 py-2 font-medium">${{ number_format($streetFood->price, 2) }}</td>
                            <td class="px-4 py-2 text-center space-x-2">
                                <a href="{{ route('streetfood.show', $streetFood->id) }}"
                                    class="text-blue-600 hover:underline">View</a>
                                <a href="{{ route('streetfood.edit', $streetFood->id) }}"
                                    class="text-yellow-600 hover:underline">Edit</a>
                                <form action="{{ route('streetfood.destroy', $streetFood->id) }}"
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:underline"
                                        onclick="return confirm('Are you sure you want to delete this?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-4 py-4 text-center text-gray-500">No street foods found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</x-layout>
