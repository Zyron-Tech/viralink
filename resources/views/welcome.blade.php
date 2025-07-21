<!DOCTYPE html>
<html lang="en" class="bg-[#0e0f16] text-white">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>ViraLink • AI Tweets & Hashtags</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="icon" type="image/png" href="{{ asset('favicon.png') }}">
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

  <!-- Animated dots -->
  <script>
    document.addEventListener('DOMContentLoaded', () => {
      for (let i = 0; i < 40; i++) {
        const dot = document.createElement('div');
        dot.classList.add('dot');
        dot.style.left = Math.random() * 100 + '%';
        dot.style.top = Math.random() * 100 + '%';
        dot.style.animationDelay = `${Math.random() * 5}s`;
        dot.style.opacity = Math.random() * 0.3;
        document.body.appendChild(dot);
      }
    });
  </script>
<!-- Include Alpine.js -->
<script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

<header class="sticky top-0 z-50 bg-[#0e0f16] backdrop-blur bg-opacity-80 border-b border-white/10 px-6 py-4">
  <div class="max-w-7xl mx-auto flex items-center justify-between">
    <!-- Logo -->
    <div class="flex items-center space-x-3">
      <div class="w-9 h-9 bg-green-500 text-[#0e0f16] font-bold rounded-md flex items-center justify-center text-lg shadow">
        V
      </div>
      <h1 class="text-2xl font-bold text-white">
        Vira<span class="text-green-500">Link</span>
      </h1>
    </div>

    <!-- Mobile Menu Button -->
    <div class="md:hidden" x-data="{ open: false }">
      <button @click="open = !open" class="text-white focus:outline-none">
        <svg x-show="!open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        <svg x-show="open" x-cloak class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M6 18L18 6M6 6l12 12" />
        </svg>

        <!-- Mobile Nav -->
        <div x-show="open" x-transition class="absolute right-6 mt-3 w-48 bg-[#1b1f2a] rounded shadow-lg py-3 text-white">
          <a href="#features" class="block px-5 py-2 hover:bg-green-500 hover:text-[#0e0f16]">Features</a>
          <a href="/donate" class="block px-5 py-2 hover:bg-green-500 hover:text-[#0e0f16]">Donation</a>
          <a href="#testimonials" class="block px-5 py-2 hover:bg-green-500 hover:text-[#0e0f16]">Testimonials</a>
          <a href="/register" class="block px-5 py-2 bg-green-500 hover:bg-green-600 text-[#0e0f16] rounded mt-2 mx-3 text-center font-semibold">
            Try It
          </a>
        </div>
      </button>
    </div>

    <!-- Desktop Nav -->
    <nav class="hidden md:flex items-center space-x-6 text-white font-medium">
      <a href="#features" class="hover:text-green-400 transition-colors duration-200">Features</a>
      <a href="/donate" class="hover:text-green-400 transition-colors duration-200">Donation</a>
      <a href="#testimonials" class="hover:text-green-400 transition-colors duration-200">Testimonials</a>
    </nav>

    <!-- Desktop CTA -->
    <div class="hidden md:block">
      <a href="/register"
        class="bg-green-500 hover:bg-green-600 text-[#0e0f16] px-5 py-2 rounded-lg font-semibold shadow-md transition duration-200">
        Try It
      </a>
    </div>
  </div>
</header>



  <!-- Hero section -->
  <section class="flex flex-col items-center justify-center text-center py-24 px-6 relative z-10">
    <span class="badge-glow px-4 py-1 rounded-full text-green-400 mb-6 text-sm font-medium inline-block"
      style="background: rgba(34,197,94,0.15); border:1px solid rgba(34,197,94,0.4);">
      🚀 Trusted by 1,000+ users
    </span>

    <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold mb-6 leading-tight max-w-3xl">
      Create Viral <span class="text-green-500">𝕏 Tweets & Threads</span> + Hashtags <br> in Minutes
    </h1>
    <p class="text-gray-400 text-lg max-w-xl mb-10">
      Generate authentic viral tweets and optimized hashtags with AI. Share engaging content faster and watch your X presence soar.
    </p>
    <a href="/register" class="flex items-center bg-green-500 hover:bg-green-600 text-black font-semibold px-6 py-3 rounded-full shadow-xl transition">
      Generate Content
      <svg class="w-5 h-5 ml-2 stroke-current" fill="none" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M17 8l4 4m0 0l-4 4m4-4H3"/>
      </svg>
    </a>
  </section>

  <!-- Features -->
<section id="features" class="py-20 px-6 max-w-6xl mx-auto relative z-10">
  <h3 class="text-4xl font-bold text-center mb-16 leading-tight">
    What <span class="text-green-500">ViraLink</span> Can Do For You
  </h3>

  <div class="grid md:grid-cols-3 sm:grid-cols-2 gap-10">
    <!-- Feature 1 -->
    <div class="bg-[#121825] p-6 rounded-xl shadow hover:shadow-lg transition duration-300 text-center">
      <div class="mb-4 flex justify-center">
        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" stroke-width="1.5"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M3 5h18M9 3v2m6-2v2M4 9h16M4 15h16M10 21h4" />
        </svg>
      </div>
      <h4 class="text-xl font-semibold mb-2 text-green-400">Viral Tweet Generator</h4>
      <p class="text-gray-400 text-sm">Craft scroll-stopping, emotional tweets ready to go viral using advanced AI.</p>
    </div>

    <!-- Feature 2 -->
    <div class="bg-[#121825] p-6 rounded-xl shadow hover:shadow-lg transition duration-300 text-center">
      <div class="mb-4 flex justify-center">
        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" stroke-width="1.5"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M7 7h10M7 11h10M7 15h10M7 19h10" />
        </svg>
      </div>
      <h4 class="text-xl font-semibold mb-2 text-green-400">Thread Builder</h4>
      <p class="text-gray-400 text-sm">Effortlessly generate engaging multi-part Twitter threads with flow and clarity.</p>
    </div>

    <!-- Feature 3 -->
    <div class="bg-[#121825] p-6 rounded-xl shadow hover:shadow-lg transition duration-300 text-center">
      <div class="mb-4 flex justify-center">
        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" stroke-width="1.5"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M17 9V7a4 4 0 10-8 0v2M5 11h14v10H5V11z" />
        </svg>
      </div>
      <h4 class="text-xl font-semibold mb-2 text-green-400">Auto Posting</h4>
      <p class="text-gray-400 text-sm">Post your tweets automatically from the platform—no manual copy-paste needed.</p>
    </div>

    <!-- Feature 4 -->
    <div class="bg-[#121825] p-6 rounded-xl shadow hover:shadow-lg transition duration-300 text-center">
      <div class="mb-4 flex justify-center">
        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" stroke-width="1.5"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M9 17v-2a2 2 0 012-2h2a2 2 0 012 2v2m-4-6h.01M12 2a10 10 0 100 20 10 10 0 000-20z" />
        </svg>
      </div>
      <h4 class="text-xl font-semibold mb-2 text-green-400">Trending Topic Insights</h4>
      <p class="text-gray-400 text-sm">Stay ahead with live insights on what's trending and where to target your tweets.</p>
    </div>

    <!-- Feature 5 -->
    <div class="bg-[#121825] p-6 rounded-xl shadow hover:shadow-lg transition duration-300 text-center">
      <div class="mb-4 flex justify-center">
        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" stroke-width="1.5"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M3 10h4l3-3 4 8 3-6 4 4M13 21h-2v-2h2v2z" />
        </svg>
      </div>
      <h4 class="text-xl font-semibold mb-2 text-green-400">Hashtag Generator</h4>
      <p class="text-gray-400 text-sm">Get 4+ optimized, trending hashtags for any post or topic—instantly.</p>
    </div>

    <!-- Feature 6 -->
    <div class="bg-[#121825] p-6 rounded-xl shadow hover:shadow-lg transition duration-300 text-center">
      <div class="mb-4 flex justify-center">
        <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" stroke-width="1.5"
          viewBox="0 0 24 24">
          <path stroke-linecap="round" stroke-linejoin="round"
            d="M3 7h18M3 12h18M3 17h18" />
        </svg>
      </div>
      <h4 class="text-xl font-semibold mb-2 text-green-400">History Tracking</h4>
      <p class="text-gray-400 text-sm">View all your past generated tweets and hashtags in one place.</p>
    </div>
  </div>
</section>


<!-- Free Forever Section -->
<section class="py-20 bg-[#0c0d13] relative z-10">
  <div class="max-w-4xl mx-auto text-center px-6">
    <div class="mb-8">
      <h2 class="text-4xl font-bold mb-4 text-white">
        100% <span class="text-green-500">Free</span>, Forever
      </h2>
      <p class="text-gray-400 text-lg">
        No hidden charges. No credit cards. No limits. Generate viral tweets, smart hashtags,
        and insights as much as you want — absolutely free.
      </p>
    </div>

    <div class="mt-10 grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 text-left">
      <div class="p-6 border border-green-700 rounded-xl bg-[#10141c]/40 backdrop-blur">
        <h4 class="text-white text-xl font-semibold mb-2">Unlimited Tweet Generation</h4>
        <p class="text-gray-400 text-sm">Create as many AI-crafted tweets, threads, and insights as you like.</p>
      </div>
      <div class="p-6 border border-green-700 rounded-xl bg-[#10141c]/40 backdrop-blur">
        <h4 class="text-white text-xl font-semibold mb-2">Free Hashtag Tool</h4>
        <p class="text-gray-400 text-sm">Access hashtag suggestions tailored to your content, for free.</p>
      </div>
      <div class="p-6 border border-green-700 rounded-xl bg-[#10141c]/40 backdrop-blur">
        <h4 class="text-white text-xl font-semibold mb-2">One step Away</h4>
        <p class="text-gray-400 text-sm">Jump straight in and start creating — you are just one step away.</p>
      </div>
    </div>

    <div class="mt-12">
      <a href="/register" class="bg-green-500 hover:bg-green-600 text-black font-bold py-3 px-6 rounded-lg text-lg transition">
        Start Generating Now
      </a>
    </div>
  </div>
</section>

  <!-- Testimonials -->
<section id="testimonials" class="py-20 px-6 bg-[#0c0d11] relative z-10">
  <h3 class="text-4xl font-bold text-center mb-14 text-white">What Real Users Are Saying</h3>
  <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
    
    <div class="testimonial bg-[#1a1d24] p-6 rounded-2xl shadow-lg border border-[#2a2d34] hover:shadow-xl transition duration-300">
      <p class="text-gray-300 italic">"I literally tweeted a post generated by ViraLink and woke up to 14K impressions. I didn’t even tweak it. Unreal."</p>
      <div class="mt-5 flex items-center gap-3">
        <img src="https://i.pravatar.cc/40?img=5" class="rounded-full w-10 h-10" alt="User avatar">
        <div>
          <p class="text-green-400 font-semibold">– Daniel O.</p>
          <p class="text-sm text-gray-500">Indie Founder</p>
        </div>
      </div>
    </div>

    <div class="testimonial bg-[#1a1d24] p-6 rounded-2xl shadow-lg border border-[#2a2d34] hover:shadow-xl transition duration-300">
      <p class="text-gray-300 italic">"I used ViraLink’s AI to generate an entire thread. Not only did it go viral, but I also gained 500+ new followers in 3 days."</p>
      <div class="mt-5 flex items-center gap-3">
        <img src="https://i.pravatar.cc/40?img=7" class="rounded-full w-10 h-10" alt="User avatar">
        <div>
          <p class="text-green-400 font-semibold">– Jide A.</p>
          <p class="text-sm text-gray-500">Tech Influencer</p>
        </div>
      </div>
    </div>

    <div class="testimonial bg-[#1a1d24] p-6 rounded-2xl shadow-lg border border-[#2a2d34] hover:shadow-xl transition duration-300">
      <p class="text-gray-300 italic">"We’re a digital agency and we now use ViraLink for all our client social posts. The engagement rates speak for themselves."</p>
      <div class="mt-5 flex items-center gap-3">
        <img src="https://i.pravatar.cc/40?img=10" class="rounded-full w-10 h-10" alt="User avatar">
        <div>
          <p class="text-green-400 font-semibold">– Anita M.</p>
          <p class="text-sm text-gray-500">Social Media Strategist</p>
        </div>
      </div>
    </div>

  </div>
</section>

  <!-- Footer -->
<footer class="bg-[#0c0d11] text-gray-400 py-10 px-6">
  <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center gap-6">
    <!-- Branding -->
    <div class="text-center md:text-left">
      <h4 class="text-xl font-bold text-white">Vira<span class="text-green-500">Link</span></h4>
      <p class="text-sm mt-1">AI Credit: Tokari Core.</p>
    </div>

    <!-- Socials -->
    <div class="flex gap-5 text-white">
      <a href="https://x.com/zyron_tech10" target="_blank" aria-label="Twitter" class="hover:text-green-500 transition">
        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
          <path d="M24 4.557a9.83 9.83 0 0 1-2.828.775 4.93 4.93 0 0 0 2.165-2.724c-.951.555-2.005.959-3.127 1.184a4.92 4.92 0 0 0-8.388 4.482A13.978 13.978 0 0 1 1.671 3.149 4.922 4.922 0 0 0 3.194 9.723a4.904 4.904 0 0 1-2.229-.616c-.054 2.281 1.581 4.415 3.949 4.89a4.935 4.935 0 0 1-2.224.084 4.925 4.925 0 0 0 4.6 3.417A9.867 9.867 0 0 1 0 19.54a13.936 13.936 0 0 0 7.548 2.212c9.056 0 14.01-7.506 14.01-14.01 0-.213-.005-.426-.014-.637A10.025 10.025 0 0 0 24 4.557z"/>
        </svg>
      </a>
      <a href="https://instagram.com/zyron-tech" target="_blank" aria-label="Instagram" class="hover:text-green-500 transition">
        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
          <path d="M12 2.163c3.204 0 3.584.012 4.85.07 1.17.054 1.97.24 2.422.403a4.92 4.92 0 0 1 1.675 1.082 4.92 4.92 0 0 1 1.082 1.675c.163.452.35 1.252.403 2.422.058 1.266.07 1.645.07 4.85s-.012 3.584-.07 4.85c-.054 1.17-.24 1.97-.403 2.422a4.902 4.902 0 0 1-1.082 1.675 4.902 4.902 0 0 1-1.675 1.082c-.452.163-1.252.35-2.422.403-1.266.058-1.645.07-4.85.07s-3.584-.012-4.85-.07c-1.17-.054-1.97-.24-2.422-.403a4.902 4.902 0 0 1-1.675-1.082 4.902 4.902 0 0 1-1.082-1.675c-.163-.452-.35-1.252-.403-2.422C2.175 15.746 2.163 15.367 2.163 12s.012-3.584.07-4.85c.054-1.17.24-1.97.403-2.422a4.92 4.92 0 0 1 1.082-1.675A4.92 4.92 0 0 1 5.323 2.636c.452-.163 1.252-.35 2.422-.403 1.266-.058 1.645-.07 4.85-.07M12 0C8.741 0 8.333.013 7.053.072 5.773.131 4.822.308 4.02.56a7.005 7.005 0 0 0-2.538 1.631A7.005 7.005 0 0 0 .56 4.02c-.252.802-.429 1.753-.488 3.033C.013 8.333 0 8.741 0 12s.013 3.667.072 4.947c.059 1.28.236 2.231.488 3.033a7.005 7.005 0 0 0 1.631 2.538 7.005 7.005 0 0 0 2.538 1.631c.802.252 1.753.429 3.033.488C8.333 23.987 8.741 24 12 24s3.667-.013 4.947-.072c1.28-.059 2.231-.236 3.033-.488a7.005 7.005 0 0 0 2.538-1.631 7.005 7.005 0 0 0 1.631-2.538c.252-.802.429-1.753.488-3.033.059-1.28.072-1.688.072-4.947s-.013-3.667-.072-4.947c-.059-1.28-.236-2.231-.488-3.033a7.005 7.005 0 0 0-1.631-2.538A7.005 7.005 0 0 0 19.98.56c-.802-.252-1.753-.429-3.033-.488C15.667.013 15.259 0 12 0zM12 5.838a6.162 6.162 0 1 0 0 12.324A6.162 6.162 0 0 0 12 5.838zm0 10.162a3.999 3.999 0 1 1 0-7.998 3.999 3.999 0 0 1 0 7.998zm6.406-11.845a1.44 1.44 0 1 0 0 2.881 1.44 1.44 0 0 0 0-2.881z"/>
        </svg>
      </a>
      <a href="https://peacemathew.com.ng" target="_blank" aria-label="Website" class="hover:text-green-500 transition">
        <svg class="w-6 h-6 fill-current" viewBox="0 0 24 24">
          <path d="M12 2C6.477 2 2 6.478 2 12c0 5.523 4.477 10 10 10s10-4.477 10-10S17.523 2 12 2zm4.9 14.32a8.027 8.027 0 0 1-2.188.932c.374-.81.608-1.678.684-2.58H17v-.8h-1.604a7.993 7.993 0 0 0-.684-2.58 8.01 8.01 0 0 1 2.188.932l.42-.724a9.106 9.106 0 0 0-2.595-1.078A8.048 8.048 0 0 0 12 7.5c-1.257 0-2.444.292-3.52.812a9.106 9.106 0 0 0-2.595 1.078l.42.724a8.01 8.01 0 0 1 2.188-.932c-.374.81-.608 1.678-.684 2.58H7v.8h1.604c.076.902.31 1.77.684 2.58a8.027 8.027 0 0 1-2.188-.932l-.42.724a9.106 9.106 0 0 0 2.595 1.078A8.048 8.048 0 0 0 12 16.5c1.257 0 2.444-.292 3.52-.812a9.106 9.106 0 0 0 2.595-1.078l-.42-.724z"/>
        </svg>
      </a>
    </div>

    

    <!-- Copyright -->
    <div class="text-sm text-center md:text-right text-gray-500 mt-4 md:mt-0">
      © 2025 ViraLink. Built by <a href="https://peacemathew.com.ng" target="_blank" class="text-green-400 hover:underline">Peace Mathew</a>
    </div>
  </div>
</footer>


</body>
</html>
