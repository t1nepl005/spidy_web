@csrf
@if(isset($streetFood))
    @method('PUT')
@endif

<div>
    <label for="food_name">Name:</label>
    <input type="text" id="food_name" name="food_name" value="{{ old('food_name', $streetFood->food_name ?? '') }}" required>
    @error('food_name')
        <div>{{ $message }}</div>
    @enderror
</div>

<div>
    <label for="description">Description:</label>
    <textarea id="description" name="description" required>{{ old('description', $streetFood->description ?? '') }}</textarea>
    @error('description')
        <div>{{ $message }}</div>
    @enderror
</div>

<div>
    <label for="price">Price:</label>
    <input type="number" id="price" name="price" value="{{ old('price', $streetFood->price ?? '') }}" required>
    @error('price')
        <div>{{ $message }}</div>
    @enderror
</div>

<div>
    <label for="image">Image URL:</label>
    <input type="text" id="image" name="image" value="{{ old('image', $streetFood->image ?? '') }}">
    @error('image')
        <div>{{ $message }}</div>
    @enderror
</div>

<button type="submit">Submit</button>