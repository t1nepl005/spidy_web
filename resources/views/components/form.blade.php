{{-- filepath: c:\Users\CLIENT\Desktop\Projects\group_page\resources\views\components\form.blade.php --}}
@csrf

<div class="mb-3">
    <label for="name" class="form-label">Name</label>
    <input 
        type="text" 
        name="name" 
        id="name" 
        class="form-control @error('name') is-invalid @enderror" 
        value="{{ old('name', $streetfood->name ?? '') }}" 
        required
    >
    @error('name')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea 
        name="description" 
        id="description" 
        class="form-control @error('description') is-invalid @enderror"
    >{{ old('description', $streetfood->description ?? '') }}</textarea>
    @error('description')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label for="price" class="form-label">Price</label>
    <input 
        type="number" 
        name="price" 
        id="price" 
        class="form-control @error('price') is-invalid @enderror" 
        value="{{ old('price', $streetfood->price ?? '') }}" 
        min="0" 
        step="0.01"
        required
    >
    @error('price')
        <div class="invalid-feedback">{{ $message }}</div>
    @enderror
</div>