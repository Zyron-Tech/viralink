<x-app-layout>
  <div class="max-w-3xl mx-auto bg-[#1a1d29] p-6 rounded text-white">
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-2xl font-bold">🕓 Tweet History</h1>

      {{-- Clear History --}}
      <form method="POST" action="{{ route('history.clear') }}" onsubmit="return confirm('Are you sure you want to delete all tweet history?');">
        @csrf
        @method('DELETE')
        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-1 rounded text-sm">
          🗑 Clear All
        </button>
      </form>
    </div>

    {{-- Tweet History Items --}}
    @forelse($tweets as $tweet)
      <div class="mb-6 border-b border-gray-700 pb-4">
        <p class="text-green-400"><strong>Prompt:</strong> {{ $tweet->prompt }}</p>
        <ul class="list-disc pl-5 mt-2 text-gray-300">
          @foreach ($tweet->responses as $t)
            <li>{{ $t }}</li>
          @endforeach
        </ul>
      </div>
    @empty
      <p class="text-gray-400">No tweets found.</p>
    @endforelse

    {{-- Pagination --}}
    <div class="mt-6">
      {{ $tweets->links() }}
    </div>
  </div>
</x-app-layout>
