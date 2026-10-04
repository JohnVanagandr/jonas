<!-- Navegación -->
<nav class="absolute top-0 w-full p-6 z-50 flex justify-between items-center animate-fade-in border-b border-white/5">
    <div class="text-xl font-bold tracking-widest uppercase text-gray-300">
        Jonas<span class="text-[#FF7518]"> Samuel</span>
    </div>
    <div class="flex gap-4 items-center">
        @auth
            <a href="{{ route('admin.dashboard') }}" class="bg-transparent border border-gray-600 px-5 py-2 rounded-full text-xs font-bold text-gray-300 hover:text-white hover:border-gray-400 hover:bg-white/5 transition-colors uppercase">Panel Admin</a>
        @endauth
    </div>
</nav>