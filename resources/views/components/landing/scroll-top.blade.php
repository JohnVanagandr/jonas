<!-- Botón Ascender (Volver Arriba - Minimalista) -->
<button 
    x-show="showScrollTop" 
    x-cloak style="display: none;"
    @click="scrollToTop(); playClick()"
    x-transition:enter="transition ease-out duration-300"
    x-transition:enter-start="opacity-0 translate-y-12"
    x-transition:enter-end="opacity-100 translate-y-0"
    x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 translate-y-0"
    x-transition:leave-end="opacity-0 translate-y-12"
    class="fixed bottom-8 right-8 z-[60] w-14 h-14 flex items-center justify-center bg-[#15181f] border border-gray-700 hover:border-[#FF7518] hover:bg-[#FF7518] text-gray-400 hover:text-white rounded-full shadow-lg transition-colors group"
    title="Ascender a la superficie">
    
    <svg class="w-6 h-6 transform group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"></path>
    </svg>
</button>