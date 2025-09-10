<x-layout>
    <h1>Edit Street Food Item</h1>

    <form action="{{ route('streetfood.update', $streetFood->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('activities.streetfood._form', ['streetFood' => $streetFood])
        
        <button type="submit">Save Changes</button>
    </form>

    <a href="{{ route('streetfood.index') }}">Back to List</a>
</x-layout>