@props([])

<!-- HERO SECTION -->
<header class="relative w-full min-h-[90vh] flex flex-col justify-center border-b border-gray-800/50 overflow-hidden py-20 md:py-32">
    
    <!-- Opacidad reducida al mínimo para que la imagen de fondo luzca limpia -->
    <div class="absolute inset-0 bg-[#0f1115]/15 pointer-events-none z-0"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 md:px-12 w-full animate-fade-in" style="animation-delay: 0.1s;">
        
        <!-- Etiqueta limpia sin iconos -->
        <span class="inline-block bg-[#FF7518]/10 border border-[#FF7518]/30 text-[#FF7518] font-bold text-xs md:text-sm px-5 py-2 rounded-full uppercase tracking-widest mb-6 shadow-sm">
            Una Mágica y Dulce Espera
        </span>

        <!-- Título principal con gran respiro y protagonismo absoluto -->
        <h1 class="font-nightmare text-5xl sm:text-7xl md:text-8xl lg:text-9xl text-white drop-shadow-[0_10px_25px_rgba(0,0,0,0.85)] mb-6 leading-none">
            El Extraño Mundo de<br>
            <span class="text-[#FF7518] inline-block mt-2">Jonas Samuel</span>
        </h1>

        <!-- Contenedor de etiquetas espaciado con fecha, hora, lugar y código de vestimenta -->
        <div class="flex flex-wrap items-center gap-3 sm:gap-6 text-gray-200 font-medium text-sm md:text-base mb-8 bg-[#15181f]/85 backdrop-blur-md px-6 py-4 rounded-2xl border border-gray-800/60 shadow-2xl max-w-fit animate-fade-in" style="animation-delay: 0.2s;">
            <div class="flex items-center gap-2">
                <span class="font-bold">Domingo, 01 Nov</span>
            </div>
            <span class="hidden sm:inline w-1 h-1 bg-gray-500 rounded-full"></span>
            <div class="flex items-center gap-2">
                <span class="font-bold">3:30 PM</span>
            </div>
            <span class="hidden sm:inline w-1 h-1 bg-gray-500 rounded-full"></span>
            <div class="flex items-center gap-2">
                <span class="">Sede Recreacional CorpoSena Girón</span>
            </div>
            <span class="hidden sm:inline w-1 h-1 bg-gray-500 rounded-full"></span>
            <div class="flex items-center gap-2">
                <span class="text-[#FF7518] font-bold">Disfraz Opcional</span>
            </div>
        </div>

        <!-- Descripción fluida y muy legible -->
        <p class="max-w-2xl text-lg md:text-xl text-gray-200 font-light leading-relaxed mb-10 animate-fade-in drop-shadow-[0_4px_10px_rgba(0,0,0,0.8)]" style="animation-delay: 0.3s;">
            Preparamos el trineo de regalos con toda la ilusión. Acompáñanos a celebrar la llegada de nuestro pequeño en una tarde llena de magia, alegría y buenos momentos. Elige un detalle para confirmar tu asistencia.
        </p>

        <!-- Botones de acción con animaciones fluidas -->
        <div class="flex flex-col sm:flex-row gap-4 animate-fade-in" style="animation-delay: 0.4s;">
            <a href="#regalos" class="bg-white hover:bg-gray-200 text-black font-bold text-sm tracking-widest uppercase px-8 py-4 rounded-full flex items-center justify-center gap-2 transition-transform active:scale-95 shadow-lg">
                Ver Lista de Regalos
            </a>
            
            <button @click.stop="toggleMusic()" class="bg-black/50 backdrop-blur-md border border-gray-600 hover:border-gray-400 hover:bg-white/10 text-white font-bold text-sm tracking-widest uppercase px-8 py-4 rounded-full flex items-center justify-center gap-2 transition-all active:scale-95 shadow-lg">
                <svg x-show="!musicPlaying" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <svg x-show="musicPlaying" x-cloak class="w-5 h-5 text-[#FF7518]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                <span x-text="musicPlaying ? 'Pausar Banda Sonora' : 'Reproducir Banda Sonora'"></span>
            </button>
        </div>

        <!-- NUEVO BOTÓN: Enlace sutil para consultar asistencia -->
        <div class="mt-8 animate-fade-in" style="animation-delay: 0.5s;">
            <button @click="$dispatch('open-check-modal')" class="text-sm text-gray-400 hover:text-[#FF7518] transition-colors underline underline-offset-4 decoration-gray-600 hover:decoration-[#FF7518]">
                ¿Ya confirmaste y olvidaste tu regalo? Consúltalo aquí.
            </button>
        </div>

    </div>
</header>