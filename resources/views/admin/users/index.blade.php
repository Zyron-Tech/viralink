<x-app-layout>
    <div class="max-w-7xl mx-auto px-4 py-10">
        <h2 class="text-2xl font-bold mb-6 text-white">Registered Users</h2>

        <div class="overflow-x-auto bg-[#1a1d24] rounded-lg shadow p-4">
            <table class="w-full text-left text-sm text-gray-300">
                <thead class="bg-[#10141c] text-green-400">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Name</th>
                        <th class="px-4 py-3">Email</th>
                        <th class="px-4 py-3">Registered</th>
                        <th class="px-4 py-3">Admin?</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr class="border-b border-gray-700 hover:bg-[#131720]">
                            <td class="px-4 py-2">{{ $user->id }}</td>
                            <td class="px-4 py-2">{{ $user->name }}</td>
                            <td class="px-4 py-2">{{ $user->email }}</td>
                            <td class="px-4 py-2">{{ $user->created_at->diffForHumans() }}</td>
                            <td class="px-4 py-2">
                                <span class="text-{{ $user->is_admin ? 'green' : 'red' }}-500 font-bold">
                                    {{ $user->is_admin ? 'Yes' : 'No' }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="mt-6">
            {{ $users->links() }}
        </div>
    </div>
</x-app-layout>
