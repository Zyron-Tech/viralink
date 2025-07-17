<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 px-4 relative">
        <h2 class="text-3xl font-bold text-green-400 mb-6 flex items-center gap-2">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" class="w-7 h-7 text-green-400">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M9 3L7 21m8-18L13 21M4 8h16M4 16h16" />
            </svg>
            AI Hashtag Generator
        </h2>

        @if (!session('has_followed'))
        <!-- 🔒 Overlay -->
        <div id="lockOverlay" class="absolute inset-0 bg-black bg-opacity-80 z-20 flex items-center justify-center rounded">
            <div class="text-center text-white p-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-12 h-12 mx-auto mb-4 text-green-400" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M12 11c1.104 0 2-.896 2-2V7a2 2 0 00-4 0v2c0 1.104.896 2 2 2zm0 0v2m0 0v2m0 4h.01" />
                </svg>
                <h3 class="text-xl font-semibold mb-2">Follow us on X to unlock this feature</h3>
                <p class="mb-4 text-gray-300">It’s 100% free and you only need to do it once.</p>
                <a href="https://twitter.com/intent/follow?screen_name=zyron_tech10" target="_blank"
                    onclick="unlockAfterFollow()"
                    class="inline-block bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded transition">
                    Follow @zyron_tech10
                </a>
            </div>
        </div>
        @endif

        <!-- ✅ Main Form -->
        <form method="POST" action="{{ route('hashtags.generate') }}"
              class="{{ session('has_followed') ? '' : 'pointer-events-none opacity-50' }}">
            @csrf
            <div class="mb-4">
                <label class="block text-white mb-2">Enter Topic or Prompt</label>
                <input type="text" name="prompt" value="{{ old('prompt') }}"
                    class="w-full p-3 rounded bg-[#1a1d24] text-white border border-gray-700 focus:outline-none focus:ring focus:border-green-500"
                    placeholder="e.g. digital marketing, climate change, fitness" required>
                @error('prompt')
                    <p class="text-red-500 mt-2">{{ $message }}</p>
                @enderror
            </div>

            <button type="submit"
                class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded transition">
                Generate Hashtags
            </button>
        </form>
    </div>

    <script>
        function unlockAfterFollow() {
            // Call a Laravel route via fetch or axios
            fetch('/followed', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                }
            }).then(res => {
                if (res.ok) {
                    document.getElementById('lockOverlay').style.display = 'none';
                    document.querySelector('form').classList.remove('pointer-events-none', 'opacity-50');
                }
            });
        }
    </script>
</x-app-layout>
