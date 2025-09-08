<x-layout>
    <h1>Create Street Food Item</h1>

    <form action="{{ route('streetfood.store') }}" method="POST">
        @csrf
        @include('activities.streetfood._form')
        
        <button type="submit">Create</button>
    </form>
</x-layout>