<x-app-layout>
  <div class="max-w-2xl mx-auto text-center">
    <h2 class="text-xl font-semibold mb-6">What topic do you want to create viral content about?</h2>

    <form method="POST" action="{{ route('generate') }}" class="bg-[#1a1d29] p-6 rounded-lg relative text-left">
      @csrf

      <textarea name="prompt" required placeholder="Enter your post draft here..." rows="4"
        class="w-full bg-transparent text-white border border-gray-700 rounded p-3 mb-4 resize-none focus:outline-none focus:ring-1 focus:ring-green-500"></textarea>

      <div class="flex items-center gap-4 mb-4">
        <select name="type" class="bg-[#10141c] border border-gray-700 text-white p-2 rounded w-full">
          <option value="single">Single Tweet</option>
          <option value="thread">Thread</option>
        </select>

        <input type="number" name="count" min="1" max="10"
          class="bg-[#10141c] border border-gray-700 text-white p-2 rounded w-full"
          placeholder="Thread count">
      </div>

      <div class="flex justify-between items-center">
        <div class="text-sm text-gray-400">Credits: unlimited</div>
        <button type="submit"
          class="bg-green-500 hover:bg-green-600 text-white p-2 rounded-full transition">
          ⬆
        </button>
      </div>
    </form>

    @isset($tweet)
      <div class="mt-10">
        <h2 class="text-lg font-bold mb-4">Generated Tweet(s):</h2>
        @foreach ($tweet->responses as $tweetText)
          <div class="mb-4 p-4 bg-[#2a2f3f] rounded">
            <p>{{ $tweetText }}</p>
            <a target="_blank" href="https://twitter.com/intent/tweet?text={{ urlencode($tweetText) }}"
              class="inline-block mt-2 text-green-400 hover:underline">Post to X</a>
          </div>
        @endforeach
      </div>
    @endisset
  </div>
</x-app-layout>
