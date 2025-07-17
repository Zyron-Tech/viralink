<x-app-layout>
  <div class="min-h-screen flex items-center justify-center bg-[#1a1d29] text-white px-4">
    <div class="max-w-xl text-center bg-[#222636] p-8 rounded-lg shadow-lg">
      <h1 class="text-4xl font-bold mb-4">🚧 Coming Soon</h1>
      <p class="text-gray-300 text-lg mb-6">
        We're currently working on something amazing! Stay tuned — this feature will be launching soon.
      </p>

      <div class="flex justify-center">
        <a href="{{ route('dashboard') }}" class="bg-green-600 hover:bg-green-700 text-white px-6 py-2 rounded-lg text-sm transition duration-300">
          ← Back to Dashboard
        </a>
      </div>

      <div class="mt-10 text-sm text-gray-500">
        &copy; {{ date('Y') }} ViraLink. All rights reserved.
      </div>
    </div>
  </div>
</x-app-layout>
