<!-- HERO SECTION -->
<header class="relative w-full min-h-[90vh] flex flex-col justify-center border-b border-gray-800/50">
    <div class="relative z-10 max-w-7xl mx-auto px-6 md:px-12 w-full pt-20 animate-fade-in" style="animation-delay: 0.1s;">
        
        <!-- Etiqueta con color sólido -->
        <span class="inline-block bg-[#FF7518]/10 border border-[#FF7518]/30 text-[#FF7518] font-bold text-xs px-4 py-1.5 rounded-full uppercase tracking-widest mb-6">
            Un Dulce Terror Está por Nacer
        </span>

        <h1 class="font-nightmare text-6xl md:text-8xl lg:text-9xl text-white drop-shadow-xl mb-2 leading-none">
            El Extraño Mundo de<br>
            <span class="text-[#FF7518]">Jonas Samuel</span>
        </h1>

        <div class="flex flex-wrap items-center gap-3 md:gap-4 text-gray-300 font-medium text-sm md:text-base mb-6 mt-6 bg-[#15181f]/80 inline-flex px-6 py-3 rounded-2xl border border-gray-800">
            <span class="text-[#FF7518] font-bold">Domingo, 01 Nov</span>
            <span class="w-1.5 h-1.5 bg-gray-600 rounded-full"></span>
            <span>Sede SENA Girón</span>
            <span class="w-1.5 h-1.5 bg-gray-600 rounded-full"></span>
            <span class="text-[#FF7518] font-bold">Disfraz Opcional</span>
        </div>

        <p class="max-w-2xl text-lg md:text-xl text-gray-400 font-light leading-relaxed mb-10">
            La cuna está preparada. Acompáñanos a celebrar la llegada de nuestro pequeño en una noche llena de misterio y ternura. Selecciona un presente para sellar tu asistencia.
        </p>

        <div class="flex flex-col sm:flex-row gap-4">
            <!-- Botón de acción primario (Sólido puro) -->
            <a href="#regalos" class="bg-white hover:bg-gray-200 text-black font-bold text-sm tracking-widest uppercase px-8 py-4 rounded-full flex items-center justify-center gap-2 transition-colors">
                Ver Lista de Regalos
            </a>
            
            <!-- Botón secundario (Ghost button elegante) -->
            <button @click.stop="toggleMusic()" class="bg-transparent border border-gray-600 hover:border-gray-400 hover:bg-white/5 text-white font-bold text-sm tracking-widest uppercase px-8 py-4 rounded-full flex items-center justify-center gap-2 transition-colors">
                <svg x-show="!musicPlaying" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <svg x-show="musicPlaying" x-cloak class="w-5 h-5 text-[#FF7518]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span x-text="musicPlaying ? 'Pausar Banda Sonora' : 'Reproducir Banda Sonora'"></span>
            </button>
        </div>
    </div>
</header>