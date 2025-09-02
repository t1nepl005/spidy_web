<x-layout title="Activity 1">
    <div class="p-fluid">
        <h1 class="text-2xl font-heading text-spider-primary mb-6">Activity 1 - Users List</h1>

        <div class="overflow-x-auto bg-spider-soft rounded-2xl shadow-soft p-4">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-spider-primary text-white rounded-xl">
                    <tr>
                        <th class="px-4 py-2 text-left">ID</th>
                        <th class="px-4 py-2 text-left">First Name</th>
                        <th class="px-4 py-2 text-left">Last Name</th>
                        <th class="px-4 py-2 text-left">Address</th>
                        <th class="px-4 py-2 text-left">Gender</th>
                        <th class="px-4 py-2 text-left">Contact</th>
                        <th class="px-4 py-2 text-left">Email</th>
                        <th class="px-4 py-2 text-left">Created At</th>
                        <th class="px-4 py-2 text-left">Updated At</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($users as $user)
                        <tr class="hover:bg-spider-soft">
                            <td class="px-4 py-2">{{ $user->id }}</td>
                            <td class="px-4 py-2">{{ $user->first_name }}</td>
                            <td class="px-4 py-2">{{ $user->last_name }}</td>
                            <td class="px-4 py-2">{{ $user->address }}</td>
                            <td class="px-4 py-2">{{ $user->gender }}</td>
                            <td class="px-4 py-2">{{ $user->contact }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->created_at->format('Y-m-d H:i') }}</td>
                            <td class="px-4 py-2">{{ $user->updated_at->format('Y-m-d H:i') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if($users->isEmpty())
                <p class="text-center text-gray-500 mt-4">No users found.</p>
            @endif
        </div>
    </div>
</x-layout>
