<!DOCTYPE html>
<html lang="en" class="bg-[#0e0f16] text-white">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ViraLink • AI Tweets & Hashtags</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      background-color: #0e0f16;
      background-image:
        radial-gradient(circle at 50% 50%, rgba(255,255,255,0.05) 1px, transparent 1px),
        linear-gradient(rgba(255,255,255,0.02) 1px, transparent 1px),
        linear-gradient(90deg, rgba(255,255,255,0.02) 1px, transparent 1px);
      background-size: 300px 300px, 50px 50px, 50px 50px;
      position: relative;
      overflow-x: hidden;
    }
    .dot {
      position: absolute;
      background-color: rgba(255,255,255,0.08);
      border-radius: 50%;
      width: 4px; height: 4px;
      animation: float 6s infinite ease-in-out;
    }
    @keyframes float {
      0%,100% { transform: translateY(0); }
      50% { transform: translateY(20px); }
    }
  </style>
</head>
<body class="relative">

<!-- Donation Page -->
<section class="min-h-screen bg-[#0c0f17] text-white px-6 py-12">
  <div class="max-w-3xl mx-auto">
    <h2 class="text-4xl font-bold text-green-400 mb-6 flex items-center gap-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="w-7 h-7 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c1.1 0 2 .9 2 2v1h2a2 2 0 012 2v5a2 2 0 01-2 2h-2v1a2 2 0 01-4 0v-1H8a2 2 0 01-2-2v-5a2 2 0 012-2h2v-1c0-1.1.9-2 2-2z"/>
      </svg>
      Support ViralLink
    </h2>

    <p class="mb-8 text-gray-300">
      This platform is completely free to use. If you’d like to support the development and growth of ViralLink, you can make a donation using the details below.
    </p>

    <!-- Bank Transfer -->
    <div class="mb-8 bg-[#10141c] p-5 rounded-xl border border-gray-800">
      <h3 class="text-xl font-semibold text-white flex items-center gap-2 mb-2">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-400" viewBox="0 0 24 24" fill="none" stroke="currentColor">
          <path d="M3 10h18M5 6h14M4 14h16M4 18h16" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Bank Transfer (NGN)
      </h3>
      <p class="text-gray-300">Account Name: <span class="text-white font-semibold">Peace Mathew</span></p>
      <p class="text-gray-300">Bank Name: <span class="text-white font-semibold">Moniepoint Microfinance Bank</span></p>
      <p class="text-gray-300">Account Number: <span class="text-white font-semibold">9032043408</span></p>
    </div>

    <!-- Crypto Section -->
    <div class="mb-8 grid gap-6 sm:grid-cols-2">
      <!-- USDT -->
      <div class="bg-[#10141c] p-5 rounded-xl border border-gray-800">
        <h3 class="text-lg font-semibold flex items-center gap-2 text-white mb-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-400" viewBox="0 0 32 32" fill="currentColor">
            <path d="M16 0C7.165 0 0 7.163 0 16c0 8.837 7.165 16 16 16 8.837 0 16-7.163 16-16 0-8.837-7.163-16-16-16zm.565 17.49v4.632h-1.88v-4.58c-2.637-.098-4.63-.625-4.63-1.25 0-.625 1.992-1.15 4.63-1.25V9.556h1.88v4.486c2.562.098 4.52.63 4.52 1.25 0 .62-1.958 1.15-4.52 1.2z"/>
          </svg>
          USDT (TRC20)
        </h3>
      <a href="https://wa.me/2349032043408" target="_blank">  <p class="text-gray-300 break-all">contact on WhatsApp for info.</p>
  </a></div>

      <!-- BTC -->
      <div class="bg-[#10141c] p-5 rounded-xl border border-gray-800">
        <h3 class="text-lg font-semibold flex items-center gap-2 text-white mb-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-400" viewBox="0 0 32 32" fill="currentColor">
            <path d="M16 0C7.163 0 0 7.163 0 16c0 7.727 5.478 14.14 12.686 15.657v-4.656C7.703 25.016 4 20.98 4 16c0-6.627 5.373-12 12-12s12 5.373 12 12c0 4.98-3.703 9.016-8.686 10.001v4.656C26.522 30.14 32 23.727 32 16c0-8.837-7.163-16-16-16z"/>
          </svg>
          Bitcoin (BTC)
        </h3>
        <a href="https://wa.me/2349032043408" target="_blank"><p class="text-gray-300 break-all">contact on WhatsApp for info.</p>
  </a></div>

      <!-- ETH -->
      <div class="bg-[#10141c] p-5 rounded-xl border border-gray-800">
        <h3 class="text-lg font-semibold flex items-center gap-2 text-white mb-1">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 text-green-400" viewBox="0 0 256 417" fill="currentColor">
            <path d="M127.6 0L124 13.9v273.6l3.6 3.7 127.4-74.5z"/>
            <path d="M127.6 0L0 216.7l127.6 74.5V0z"/>
            <path d="M127.6 314.1L124.6 317.3v98.9l3 1.8 127.6-178.6z"/>
            <path d="M127.6 417v-102.9l-127.6-74.5z"/>
          </svg>
          Ethereum (ETH)
        </h3>
        <a href="https://wa.me/2349032043408" target="_blank"><p class="text-gray-300 break-all">contact on WhatsApp for info.</p>
  </a> </div>
    </div>

    <!-- Contact on WhatsApp -->
    <div class="text-center mt-10">
      <a href="https://wa.me/2349032043408" target="_blank"
         class="inline-flex items-center gap-2 bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-full transition shadow-lg">
        <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
          <path d="M.057 24l1.687-6.163a11.933 11.933 0 01-1.587-5.945C.157 5.352 5.52 0 12.065 0c3.2 0 6.2 1.24 8.477 3.514a11.877 11.877 0 013.49 8.436c-.003 6.544-5.368 11.907-11.91 11.907a11.95 11.95 0 01-5.688-1.447L.057 24zm6.597-3.807c1.676.995 3.276 1.591 5.411 1.593 5.448 0 9.887-4.434 9.89-9.883.002-5.462-4.416-9.89-9.886-9.89-5.455 0-9.888 4.435-9.888 9.89a9.823 9.823 0 001.523 5.26l-.998 3.648 3.948-1.618zm11.387-5.464c-.074-.124-.272-.198-.57-.347-.297-.149-1.758-.868-2.03-.967-.272-.099-.47-.149-.668.15-.198.297-.767.966-.94 1.164-.173.198-.347.223-.644.074-.297-.149-1.255-.462-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.297-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.372-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51l-.57-.01c-.198 0-.52.074-.792.372s-1.04 1.016-1.04 2.479 1.065 2.876 1.213 3.074c.149.198 2.095 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.226 1.36.194 1.872.118.571-.085 1.758-.719 2.006-1.413.248-.695.248-1.29.173-1.414z"/>
        </svg>
        Contact Me on WhatsApp
      </a>
    </div>

    <div class="text-center mt-10">
  <a href="/"
     class="inline-flex items-center gap-2 bg-green-700 hover:bg-green-800 text-white px-6 py-3 rounded-full transition shadow-lg">
    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
      <path d="M15 18l-6-6 6-6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </svg>
    Go back to ViraLink
  </a>
</div>

  </div>
</section>
</body>