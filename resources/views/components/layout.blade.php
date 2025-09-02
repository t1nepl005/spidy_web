@props([
    'title' => 'DC Team',
    'wrapped' => true,
    'bgImagePath' => 'images/spiderbg.jpg',
    'jsResources' => null,
    'cssResources' => null,
    'bootstrapWrapped' => false,
    ])

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $title }}</title>

    @vite('resources/css/app.css')
    @vite('resources/js/app.js')
    {{-- other resources --}}
    {{-- js resource --}}
    @if (isset($jsResources))
        @if (is_array($jsResources))
            @foreach ($jsResources as $jsResource)
                @vite('resources/js/' . $jsResource . '.js')
            @endforeach
        @else
            @vite('resources/js/' . $jsResources . '.js')
        @endif
    @endif

    {{-- css Resource --}}
    @if (isset($cssResources))
        @if (is_array($cssResources))
            @foreach ($cssResources as $cssResource)
                @vite('resources/css/' . $cssResource . '.css')
            @endforeach
        @else
            @vite('resources/css/' . $cssResources . '.css')
        @endif
    @endif

    {{-- page wrapped/isolated in boostrap5 --}}
    @if ($bootstrapWrapped)
        @vite('resources/js/bootstrap5.js')
    @endif
    <style>
        body {
            @if ($bgImagePath) 
            background: url('{{ asset($bgImagePath) }}') no-repeat center center fixed;
            @else
            background-color: var(---color-spider-soft);
            @endif
            background-size: cover;
            
        }
    </style>
</head>
<body class="text-gray-900">
    <nav class="sticky top-0 z-50 bg-white/30 backdrop-blur border-b">
        <div class="max-w-5xl mx-auto px-4 py-3 flex items-center justify-between">
            <a href="/" class="font-bold tracking-tight text-lg">Spidy company</a>
            <nav class="flex items-center gap-6 text-sm">
                <a href="/#welcome" class="hover:text-blue-600">Welcome</a>
                <a href="/#group" class="hover:text-blue-600">The Group</a>
                <a href="/#about" class="hover:text-blue-600">About</a>
                <a href="/activities" class="px-3 py-1.5 rounded-lg border hover:bg-gray-50">Activities</a>
            </nav>
        </div>
    </nav>
    <div class="min-h-[100vh]">
        
            <!-- Main content -->
            @if ($wrapped)
            <main class="max-w-5xl mx-auto px-4 py-10 ">
                <div class="rounded-2xl bg-gradient-to-br from-pink-100/70 via-white/60 to-white/40 backdrop-blur-md shadow-xl p-8">
                    @if ($bootstrapWrapped)
                        <div class="bootstrap-scope">
                            {{ $slot}}
                        </div>
                        @else
                        {{ $slot}}
                    @endif
                </div>
            </main>
            @else
                @if ($bootstrapWrapped)
                        <div class="bootstrap-scope">
                            {{ $slot}}
                        </div>
                        @else
                        {{ $slot}}
                    @endif
            @endif
    </div>

    <!-- Footer -->
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
