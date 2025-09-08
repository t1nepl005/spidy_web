<x-layout>
    <div class="container">
        <h1>Street Food Items</h1>
        <a href="{{ route('streetfood.create') }}" class="btn btn-primary">Add New Street Food</a>
        
        <table class="table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($streetFoods as $streetFood)
                    <tr>
                        <td>{{ $streetFood->food_name }}</td>
                        <td>{{ $streetFood->description }}</td>
                        <td>${{ $streetFood->price }}</td>
                        <td>
                            <a href="{{ route('streetfood.show', $streetFood->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('streetfood.edit', $streetFood->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('streetfood.destroy', $streetFood->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</x-layout>