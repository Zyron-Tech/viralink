<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>{{ config('app.name', 'ViraLink') }}</title>

    <!-- Assets -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-[#0f1117] text-white font-sans antialiased">

    <div class="min-h-screen flex flex-col items-center justify-center px-4">
        <div class="mb-8 text-center">
            <a href="/">
                <h1 class="text-4xl font-bold">Vira<span class="text-green-400">Link</span></h1>
            </a>
            <p class="text-gray-400 mt-2 text-sm">Stay Viral, Stay Relevant</p>
        </div>

        <div class="w-full max-w-md bg-[#1a1d24] border border-[#2a2d36] rounded-xl shadow-lg p-6">
            {{ $slot }}
        </div>
    </div>

</body>
</html>
