<x-app-layout>
  <div class="max-w-4xl mx-auto px-4 py-10 space-y-8">
    {{-- Profile Summary --}}
    <div class="bg-[#1a1d29] p-6 rounded-lg shadow text-white flex flex-col sm:flex-row items-center sm:items-start gap-6">
      <div class="flex-shrink-0">
        <div class="w-24 h-24 rounded-full bg-green-500 flex items-center justify-center text-3xl font-bold">
          {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
        </div>
      </div>
      <div>
        <h2 class="text-2xl font-bold mb-1">{{ auth()->user()->name }}</h2>
        <p class="text-gray-400">{{ auth()->user()->email }}</p>
        <p class="mt-2 text-sm text-gray-500">Member since {{ auth()->user()->created_at->format('F Y') }}</p>
      </div>
    </div>

    {{-- Update Profile Info --}}
    <div class="bg-[#1a1d29] p-6 rounded-lg shadow text-white">
      <h3 class="text-xl font-semibold mb-4">🧾 Update Profile Info</h3>
      <div class="max-w-2xl">
        @include('profile.partials.update-profile-information-form')
      </div>
    </div>

    {{-- Change Password --}}
    <div class="bg-[#1a1d29] p-6 rounded-lg shadow text-white">
      <h3 class="text-xl font-semibold mb-4">🔒 Change Password</h3>
      <div class="max-w-2xl">
        @include('profile.partials.update-password-form')
      </div>
    </div>

<!-- {{-- Preferences / Settings (LOCAL STORAGE) --}}
<div class="bg-[#1a1d29] p-6 rounded-lg shadow text-white">
  <h3 class="text-xl font-semibold mb-4">⚙️ Preferences</h3>

  <form id="theme-form">
    {{-- Theme Selector --}}
    <div class="mb-4">
      <label class="block mb-1 text-gray-300">🌓 Theme</label>
      <select id="theme-select" class="w-full bg-[#10141c] text-white border border-gray-700 rounded p-2">
        <option value="dark">Dark</option>
        <option value="light">Light</option>
        <option value="system">System Default</option>
      </select>
    </div>

    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded">
      Save Theme Locally
    </button>
  </form>
</div> -->

    {{-- Delete Account --}}
    <div class="bg-[#1a1d29] p-6 rounded-lg shadow text-white">
      <h3 class="text-xl font-semibold mb-4">🗑 Delete Account</h3>
      <div class="max-w-2xl">
        @include('profile.partials.delete-user-form')
      </div>
    </div>
  </div>
</x-app-layout>
