<x-layout>
    <div class="container">
        <h1>{{ $streetFood->food_name }}</h1>
        <img src="{{ $streetFood->image_url }}" alt="{{ $streetFood->name }}" class="img-fluid">
        <p><strong>Description:</strong> {{ $streetFood->description }}</p>
        <p><strong>Price:</strong> ${{ number_format($streetFood->price, 2) }}</p>

        <div class="mt-4">
            <a href="{{ route('streetfood.edit', $streetFood->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('streetfood.destroy', $streetFood->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{ route('streetfood.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</x-layout>