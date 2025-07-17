<x-app-layout>
    <div class="max-w-2xl mx-auto mt-10 px-4">
        <h2 class="text-3xl font-bold text-green-400 mb-6">✅ Generated Hashtags</h2>

        <div class="bg-[#1a1d24] text-white p-4 rounded mb-6 flex items-center justify-between">
            <p id="hashtagsText" class="text-lg break-all">{{ $hashtags }}</p>
            <button onclick="copyHashtags()" class="ml-4 text-green-400 hover:text-green-500" title="Copy Hashtags">
                <!-- SVG: Copy Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none"
                    viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2M16 8h2a2 2 0 012 2v8a2 2 0 01-2 2h-8a2 2 0 01-2-2v-2" />
                </svg>
            </button>
        </div>

        <a href="{{ route('hashtags.form') }}"
            class="inline-block bg-gray-700 hover:bg-gray-800 text-white px-4 py-2 rounded transition">
            Generate Another
        </a>
    </div>

    <script>
        function copyHashtags() {
            const hashtags = document.getElementById('hashtagsText').textContent;
            navigator.clipboard.writeText(hashtags).then(() => {
                alert('Copied to clipboard!');
            }).catch(() => {
                alert('Failed to copy.');
            });
        }
    </script>
</x-app-layout>
