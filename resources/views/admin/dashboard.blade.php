<x-app-layout>
    <div class="p-6 bg-[#10141c] text-white min-h-screen">
        <h1 class="text-3xl font-bold mb-8">Admin Dashboard</h1>

        {{-- Stats --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-10">
            <div class="bg-[#1f2937] p-6 rounded-lg shadow-md flex items-center space-x-4">
                <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M17 20h5v-2a3 3 0 00-5.356-1.857M9 20H4v-2a3 3 0 015.356-1.857M9 11h6M9 7h6M5 20h14a2 2 0 002-2V6a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                <div>
                    <h2 class="text-xl font-semibold">Total Users</h2>
                    <p class="text-green-400 text-2xl">{{ $userCount }}</p>
                </div>
            </div>
        </div>

        {{-- Signup Chart --}}
        <div class="bg-[#1f2937] p-6 rounded-lg shadow-md mb-10">
            <h2 class="text-2xl font-bold mb-4">Daily Signups</h2>
            <canvas id="signupChart" class="w-full h-64"></canvas>
        </div>

        <div class="bg-[#1f2937] p-6 rounded-lg shadow-md flex items-center space-x-4">
    <svg class="w-10 h-10 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
              d="M8 17l4-4 4 4m0-8l-4 4-4-4"/>
    </svg>
    <div>
        <h2 class="text-xl font-semibold">Total Tweets Today</h2>
        <p class="text-yellow-400 text-2xl">{{ array_sum($tweetsToday->toArray()) }}</p>
    </div>
</div>


        {{-- Recent Users --}}
        <div class="bg-[#1f2937] p-6 rounded-lg shadow-md mb-10">
            <h2 class="text-2xl font-bold mb-4">Recent Signups</h2>
            <div class="overflow-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-300 text-sm uppercase">
                            <th class="py-2 px-4">Name</th>
                            <th class="py-2 px-4">Email</th>
                            <th class="py-2 px-4">Joined</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentUsers as $user)
                            <tr class="border-t border-gray-700 hover:bg-gray-800">
                                <td class="py-2 px-4">{{ $user->name }}</td>
                                <td class="py-2 px-4">{{ $user->email }}</td>
                                <td class="py-2 px-4">{{ $user->created_at->diffForHumans() }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{-- All Users --}}
        <div class="bg-[#1f2937] p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-bold mb-4">All Users</h2>
            <div class="overflow-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="text-gray-300 text-sm uppercase">
                            <th class="py-2 px-4">Name</th>
                            <th class="py-2 px-4">Email</th>
                            <th class="py-2 px-4">Joined</th>
                            <th class="py-2 px-4">Admin?</th>
                            <th class="py-2 px-4">Action</th>
                            <th class="py-2 px-4">Total Tweets</th>
                            <th class="py-2 px-4">Tweets Today</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-t border-gray-700 hover:bg-gray-800">
                                <td class="py-2 px-4">{{ $user->name }}</td>
                                <td class="py-2 px-4">{{ $user->email }}</td>
                                <td class="py-2 px-4">{{ $user->created_at->format('d M Y') }}</td>
                                <td class="py-2 px-4">
                                    @if($user->is_admin)
                                        <span class="text-green-400">Yes</span>
                                    @else
                                        <span class="text-red-400">No</span>
                                    @endif
                                </td>
                                <td class="py-2 px-4">
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-400 hover:underline">Delete</button>
                                    </form>
                                </td>
                                <td class="py-2 px-4">{{ $user->tweets_count }}</td>
                                <td class="py-2 px-4">{{ $tweetsToday[$user->id] ?? 0 }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Chart.js --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('signupChart').getContext('2d');
        const signupChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode($chartLabels) !!}, // e.g. ['Mon', 'Tue', 'Wed']
                datasets: [{
                    label: 'Signups',
                    data: {!! json_encode($chartData) !!},   // e.g. [3, 5, 7]
                    backgroundColor: 'rgba(34,197,94,0.1)',
                    borderColor: '#22c55e',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { labels: { color: '#fff' } }
                },
                scales: {
                    x: { ticks: { color: '#ccc' } },
                    y: { ticks: { color: '#ccc' } }
                }
            }
        });
    </script>
</x-app-layout>
