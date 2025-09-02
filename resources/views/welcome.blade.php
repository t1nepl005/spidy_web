@props(['members' => []])

<x-layout>
    <section id="welcome" class="py-16 text-black">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h1 class="text-4xl font-bold mb-4 text-black">🕷 Welcome to SpidyWeb Creations</h1>
            <p class="text-lg text-gray-700">See here the compilations and activities made by our group. Powered with laravel, we are dedicated to create efficient and effective systems that reflects our learnings as Information Technology students.</p>
        </div>
    </section>

    {{-- The Group --}}
    <section id="group" class="py-16">
        <div class="max-w-4xl mx-auto px-6">
            <h2 class="text-3xl font-semibold mb-6 text-pink-600"> The Group</h2>

            <div class="space-y-4">
                @forelse ($members as $m)
                    <a href="/member/{{$m['url_route']}}" 
                        class="flex items-center gap-4 p-5 bg-pink-50 border border-pink-200 rounded-2xl hover:shadow-lg hover:bg-pink-100 transition">
                            
                            <img src="{{ asset($m['img_path']) }}" alt="{{ $m['name'] }}" 
                                class="w-14 h-14 rounded-full object-cover border-2 border-black">
                            
                            <div class="flex-1 min-w-0">
                                <p class="font-medium text-black">{{ $m['name'] }}</p>
                                <p class="text-sm text-gray-700 break-words">
                                    {{ $m['bio'] }}
                                </p>
                            </div>
                            
                            <span class="text-sm text-black font-semibold shrink-0">View →</span>
                        </a>
                @empty
                    <p class="text-gray-500">No members yet.</p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- About --}}
    <section id="about" class="py-16  text-black">
        <div class="max-w-4xl mx-auto px-6 text-center">
            <h2 class="text-3xl font-semibold mb-4"> About Us</h2>
            <p class="text-lg max-w-2xl mx-auto">
                We build things together — clean, modular, and maintainable.
                Inspired by "spidy-heroes" <span class="text-black font-bold">powerful yet stylish.</span>
            </p>
        </div>
    </section>
</x-layout>
