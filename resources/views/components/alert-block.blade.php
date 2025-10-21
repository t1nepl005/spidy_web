<div 
    x-data="{ show: true }" 
    x-show="show" 
    x-transition 
    class="flex items-center justify-between bg-green-100 text-green-800 border border-green-300 px-4 py-2 rounded mb-3"
>
    <span>{{ $slot }}</span>

    <!-- Close button -->
    <button 
        @click="show = false" 
        class="text-green-700 hover:text-green-900 ml-2"
    >
        ✕
    </button>
</div>
