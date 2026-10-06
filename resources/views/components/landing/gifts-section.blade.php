@props(['gifts'])

<!-- SECCIÓN DE REGALOS -->
<main id="regalos" class="max-w-7xl mx-auto px-6 md:px-12 py-24 relative z-10">
    
    <div class="mb-12 animate-fade-in">
        <!-- Título principal con la tipografía temática[cite: 9] -->
        <h2 class="font-nightmare text-4xl sm:text-5xl text-[#FF7518] mb-3 tracking-wide">El trineo de regalos</h2>
        <!-- Texto con mejor contraste y tono más cálido[cite: 9] -->
        <p class="text-gray-300 text-base md:text-lg font-light">Selecciona un obsequio de la lista para acompañarnos en esta dulce espera.</p>
    </div>

    @if($gifts->isEmpty())
        <!-- ESTADO: TRINEO LLENO (Diseño Premium Temático) -->
        <div class="relative w-full max-w-4xl mx-auto my-12 group reveal-card">
            <!-- Borde exterior difuminado con gradiente para dar efecto "Glow" -->
            <div class="absolute -inset-1 bg-gradient-to-r from-[#7C3AED] via-[#FF7518] to-[#7C3AED] rounded-3xl blur-[12px] opacity-40 group-hover:opacity-70 transition duration-1000 group-hover:duration-200"></div>
            
            <div class="relative bg-[#12141c] border border-purple-500/30 rounded-3xl p-10 md:p-16 text-center overflow-hidden shadow-2xl">
                
                <!-- Efecto de iluminación interna mágica -->
                <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-[#7C3AED] opacity-20 blur-[80px] rounded-full pointer-events-none"></div>

                <!-- Icono temático (Regalo / Trineo) -->
                <div class="flex justify-center mb-8 relative z-10">
                    <div class="relative">
                        <div class="absolute inset-0 bg-[#FF7518] blur-xl opacity-40 animate-pulse rounded-full"></div>
                        <svg class="relative w-20 h-20 text-[#FF7518] drop-shadow-[0_0_15px_rgba(255,117,24,0.4)] transform hover:scale-110 transition-transform duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M21 11.25v8.25a1.5 1.5 0 0 1-1.5 1.5H5.25a1.5 1.5 0 0 1-1.5-1.5v-8.25M12 4.875A2.625 2.625 0 1 0 9.375 7.5H12m0-2.625V7.5m0-2.625A2.625 2.625 0 1 1 14.625 7.5H12m0 0V21m-8.625-9.75h18c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125h-18c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125Z" />
                        </svg>
                    </div>
                </div>

                <!-- Mensaje Central -->
                <h3 class="relative z-10 text-3xl md:text-5xl font-bold text-white mb-6 leading-tight font-nightmare drop-shadow-md">
                    ¡El Trineo está <span class="text-[#FF7518] bg-clip-text">Completamente Lleno!</span>
                </h3>
                
                <p class="relative z-10 text-lg md:text-xl text-gray-300 font-light leading-relaxed max-w-2xl mx-auto">
                    Nuestros corazones están desbordados de alegría. Todos los obsequios han sido reservados. 
                    Estamos inmensamente felices y agradecidos de poder compartir con nuestro pequeño 
                    <strong class="text-[#FF7518] font-bold tracking-wide">Jonas Samuel</strong> esta celebración tan mágica.
                </p>

                <div class="relative z-10 mt-10 inline-block">
                    <span class="px-6 py-2 rounded-full border border-purple-500/30 bg-purple-500/10 text-sm text-purple-300 font-bold tracking-widest uppercase shadow-[0_0_15px_rgba(124,58,237,0.2)] animate-pulse">
                        ¡Gracias por hacer esta noche inolvidable!
                    </span>
                </div>
                
            </div>
        </div>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($gifts as $index => $gift)
                <x-landing.gift-card :gift="$gift" :index="$index" />
            @endforeach
        </div>
    @endif

</main>