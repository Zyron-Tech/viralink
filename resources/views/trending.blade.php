<x-app-layout>
    <div class="max-w-3xl mx-auto mt-8 px-4">
        <h2 class="text-3xl font-bold text-green-400 mb-6">#️⃣ Smart Hashtag Generator</h2>

        <form action="{{ url('/generate-hashtags') }}" method="POST" class="mb-6">
            @csrf
            <div class="flex flex-col sm:flex-row items-center gap-4">
                <input type="text" name="topic" placeholder="Enter a topic or keyword (e.g. crypto, health)" 
                    value="{{ old('topic', $topic ?? '') }}"
                    class="w-full sm:w-2/3 p-2 rounded bg-[#1a1d24] text-white border border-gray-700 focus:outline-none focus:ring focus:border-green-500" />

                <button type="submit" 
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded transition">
                    Generate Hashtags
                </button>
            </div>

            @error('topic')
                <p class="text-red-500 mt-2">{{ $message }}</p>
            @enderror
        </form>

        @if(isset($hashtags) && count($hashtags))
            <div class="bg-[#1a1d24] p-4 rounded-lg shadow text-white relative">
                <h3 class="text-xl font-semibold mb-2">Top Hashtags for "{{ $topic }}"</h3>
                
                <p id="hashtagText" class="text-green-400 text-lg break-words">
                    {{ implode(' ', $hashtags) }}
                </p>

                <button onclick="copyHashtags()" class="absolute top-4 right-4 text-gray-300 hover:text-white transition" title="Copy">
                    📋
                </button>
            </div>

            <script>
                function copyHashtags() {
                    const text = document.getElementById('hashtagText').innerText;
                    navigator.clipboard.writeText(text).then(() => {
                        alert('Hashtags copied to clipboard!');
                    }).catch(err => {
                        alert('Failed to copy hashtags.');
                    });
                }
            </script>
        @elseif(isset($hashtags))
            <p class="text-gray-400 mt-10">No hashtags could be generated. Try a different topic.</p>
        @endif
    </div>
</x-app-layout>
