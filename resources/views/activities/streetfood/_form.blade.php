@csrf
@if(isset($streetFood))
    @method('PUT')
@endif

<div class="space-y-4">
    {{-- Food Name --}}
    <div>
        <label for="food_name" class="block text-sm font-medium text-gray-700">Name</label>
        <input type="text" id="food_name" name="food_name"
            value="{{ old('food_name', $streetFood->food_name ?? '') }}"
            required
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('food_name')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Description --}}
    <div>
        <label for="description" class="block text-sm font-medium text-gray-700">Description</label>
        <textarea id="description" name="description" required
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $streetFood->description ?? '') }}</textarea>
        @error('description')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Price --}}
    <div>
        <label for="price" class="block text-sm font-medium text-gray-700">Price</label>
        <input type="number" id="price" name="price"
            step="0.01"
            value="{{ old('price', $streetFood->price ?? '') }}"
            required
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('price')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Image URL --}}
    <div>
        <label for="image" class="block text-sm font-medium text-gray-700">Image URL</label>
        <input type="text" id="image" name="image"
            value="{{ old('image', $streetFood->image ?? '') }}"
            class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
        @error('image')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>
