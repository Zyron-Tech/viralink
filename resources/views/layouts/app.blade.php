<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>{{ config('app.name', 'ViraLink') }}</title>
  <!-- <script src="https://cdn.tailwindcss.com"></script> -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0f1117] text-white font-sans antialiased">
    <script>
  // Immediately apply saved theme on page load
  function applyTheme(theme) {
    const html = document.documentElement;

    if (theme === 'dark') {
      html.classList.add('dark');
    } else if (theme === 'light') {
      html.classList.remove('dark');
    } else {
      // system default
      const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
      html.classList.toggle('dark', prefersDark);
    }
  }

  const savedTheme = localStorage.getItem('theme') || 'system';
  applyTheme(savedTheme);

  // Handle theme change form
  document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('theme-form');
    const select = document.getElementById('theme-select');

    // Set current value from localStorage
    select.value = savedTheme;

    form.addEventListener('submit', function (e) {
      e.preventDefault();
      const selectedTheme = select.value;
      localStorage.setItem('theme', selectedTheme);
      applyTheme(selectedTheme);
      alert('Theme saved locally!');
    });
  });
</script>

  <div class="flex flex-col md:flex-row min-h-screen">

    {{-- Mobile top nav --}}
    <div class="md:hidden bg-[#10141c] p-4 flex justify-between items-center">
      <h1 class="text-xl font-bold">Vira<span style="color:lightgreen;">Link</span></h1>
      <div>
        <button onclick="toggleMobileMenu()" class="text-white focus:outline-none">
            ☰
        </button>

      </div>
    </div>

    {{-- Mobile dropdown nav --}}
    <!-- Mobile Off-Canvas Sidebar -->
<div id="mobile-sidebar" class="fixed inset-0 z-40 hidden">
  <!-- Backdrop -->
  <div onclick="toggleMobileMenu()" class="absolute inset-0 bg-black bg-opacity-50"></div>

  <!-- Sidebar Panel -->
<div class="absolute left-0 top-0 w-64 h-full bg-[#10141c] p-6 text-white transform -translate-x-full transition-transform duration-300 ease-in-out flex flex-col" id="mobile-sidebar-panel">
  <h1 class="text-2xl font-bold mb-10">Vira<span class="text-green-400">Link</span></h1>

  <nav class="space-y-4">
    <!-- Generate -->
    <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:text-green-400">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
           viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/>
        <path d="M20 3v4M22 5h-4M4 17v2M5 18H3"/>
      </svg>
      <span>Generate</span>
    </a>

    <!-- Trending Topics -->
    <a href="/soon" class="flex items-center gap-2 hover:text-green-400">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
           viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M3 17l6-6 4 4 8-8M14 5h7v7" />
      </svg>
      <span>Trending Topics</span>
    </a>

    <!-- Hashtag Generator -->
    <a href="/hashtags" class="flex items-center gap-2 hover:text-green-400">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
           viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round" 
              d="M7 10h10M7 14h10M10 3L8 21M16 3l-2 18" />
      </svg>
      <span>Hashtag Generator</span>
    </a>

    <!-- History -->
    <a href="{{ route('history') }}" class="flex items-center gap-2 hover:text-green-400">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
           viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
      </svg>
      <span>History</span>
    </a>

    <!-- Profile -->
    <a href="/profile" class="flex items-center gap-2 hover:text-green-400">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
           viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
        <path stroke-linecap="round" stroke-linejoin="round"
              d="M5.121 17.804A7.5 7.5 0 0112 15.5a7.5 7.5 0 016.879 2.304M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
      </svg>
      <span>Profile</span>
    </a>
  </nav>

  <!-- Push the email section to the bottom -->
  <div class="mt-auto pt-10 text-sm">
    <div class="flex items-center gap-2">
      <div class="w-6 h-6 bg-green-500 rounded-full flex items-center justify-center text-sm">
        <a href='/profile'>{{ strtoupper(substr(auth()->user()->email, 0, 1)) }}</a>
      </div>
      <a href='/profile'>{{ auth()->user()->email }}</a>
    </div>
    <br>
    <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition duration-300 ease-in-out">
    Logout
</button>

</form>
  </div>
</div>


</div>


    {{-- Sidebar (Desktop only) --}}
    <aside class="hidden md:flex md:w-64 bg-[#10141c] p-6 flex-col justify-between">
      <div>
        <h1 class="text-2xl font-bold mb-10">Vira<span style="color:lightgreen;">Link</span></h1>
<nav class="space-y-4">
  <!-- Generate -->
  <a href="{{ route('dashboard') }}" class="flex items-center gap-2 hover:text-green-400">
    <!-- Sparkles Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path d="M9.937 15.5A2 2 0 0 0 8.5 14.063l-6.135-1.582a.5.5 0 0 1 0-.962L8.5 9.936A2 2 0 0 0 9.937 8.5l1.582-6.135a.5.5 0 0 1 .963 0L14.063 8.5A2 2 0 0 0 15.5 9.937l6.135 1.581a.5.5 0 0 1 0 .964L15.5 14.063a2 2 0 0 0-1.437 1.437l-1.582 6.135a.5.5 0 0 1-.963 0z"/>
      <path d="M20 3v4M22 5h-4M4 17v2M5 18H3"/>
    </svg>
    <span>Generate</span>
  </a>


  <a href="/soon" class="flex items-center gap-2 hover:text-green-400">
  <!-- Trending SVG -->
  <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
       viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round"
          d="M3 17l6-6 4 4 8-8M14 5h7v7" />
  </svg>
  <span>Trending Topics</span>
</a>



   <!--Hashtags generator-->
  <a href="/hashtags" class="flex items-center gap-2 hover:text-green-400">
     <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" 
       viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
    <path stroke-linecap="round" stroke-linejoin="round" 
          d="M7 10h10M7 14h10M10 3L8 21M16 3l-2 18" />
  </svg>
    <span>Hashtag Generator</span>
  </a>


  <!-- History -->
  <a href="{{ route('history') }}" class="flex items-center gap-2 hover:text-green-400">
    <!-- Clock History Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
    </svg>
    <span>History</span>
  </a>



  <!-- Profile -->
  <a href="/profile" class="flex items-center gap-2 hover:text-green-400">
    <!-- User Icon -->
    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
         viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
      <path stroke-linecap="round" stroke-linejoin="round"
            d="M5.121 17.804A7.5 7.5 0 0112 15.5a7.5 7.5 0 016.879 2.304M15 11a3 3 0 11-6 0 3 3 0 016 0z"/>
    </svg>
    <span>Profile</span>
  </a>
</nav>


      </div>
      <div class="text-sm mt-10">
        <div class="flex items-center gap-2">
          <div class="w-8 h-8 bg-green-500 rounded-full flex items-center justify-center">
            <a href='/profile'>{{ strtoupper(substr(auth()->user()->email, 0,1)) }}</a>
          </div>
          <span><a href='/profile'>{{ auth()->user()->email }}</a></span>
        </div>
        <br>
        <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-5 rounded-lg shadow-md transition duration-300 ease-in-out">
    Logout
</button>

</form>

      </div>

      
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-4 md:p-10 overflow-y-auto">
      {{ $slot }}
    </main>
  </div>
  <script>
  function toggleMobileMenu() {
    const sidebar = document.getElementById('mobile-sidebar');
    const panel = document.getElementById('mobile-sidebar-panel');
    const isOpen = !sidebar.classList.contains('hidden');

    if (isOpen) {
      panel.classList.add('-translate-x-full');
      setTimeout(() => {
        sidebar.classList.add('hidden');
      }, 300); // match the transition duration
    } else {
      sidebar.classList.remove('hidden');
      setTimeout(() => {
        panel.classList.remove('-translate-x-full');
      }, 10); // slight delay for transition
    }
  }
</script>

</body>
</html>
