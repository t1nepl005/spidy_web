@props(['title' => config('app.name')])

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    {{-- Tailwind via CDN for quick start --}}
    <script src="https://cdn.tailwindcss.com"></script>

    {{-- Add custom styles if needed --}}
    <style>
        body {
            background: url('{{ asset('images/spiderbg.jpg') }}') no-repeat center center fixed;
            background-size: cover;
            
        }
    </style>
</head>
<body class="text-gray-900">
    <!-- Header -->
    <header class="sticky top-0 z-50 bg-white/30 backdrop-blur border-b">
        <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="/" class="font-bold tracking-tight text-lg">DC Team</a>
            <nav class="flex items-center gap-6 text-sm">
                <a href="/#welcome" class="hover:text-blue-600">Welcome</a>
                <a href="/#group" class="hover:text-blue-600">The Group</a>
                <a href="/#about" class="hover:text-blue-600">About</a>
                <a href="/activities" class="px-3 py-1.5 rounded-lg border hover:bg-gray-50">Activities</a>
            </nav>
        </div>
    </header>

    <!-- Main content -->
    <main class="max-w-5xl mx-auto px-4 py-10">
        <div class="rounded-2xl bg-gradient-to-br from-pink-100/70 via-white/60 to-white/40 backdrop-blur-md shadow-xl p-8">
            {{ $slot }}
        </div>
    </main>

    <!-- Footer -->
    {{-- Footer --}}
    <footer class="py-6 bg-black text-white text-center">
        <p>&copy; {{ date('Y') }} Spidyweb creations. All rights reserved.</p>
    </footer>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
<script>
  document.addEventListener('alpine:init', () => {
    Alpine.store('isMobile', window.innerWidth < 640); // sm = 640px
  });
</script>

</body>
</html>
