@props(['gift', 'index'])

<!-- Tarjeta minimalista con bordes y acentos en tono morado para contraste temático -->
<div class="reveal-card relative w-full bg-[#12141c] border {{ $gift->guest_id ? 'opacity-60 grayscale-[20%] border-gray-900' : 'border-purple-500/20 hover:border-purple-500/60 hover:shadow-[0_0_25px_rgba(139,92,246,0.2)]' }} rounded-3xl p-6 md:p-7 flex flex-col justify-between transition-all duration-300 shadow-xl"
     style="--card-delay: {{ ($index % 4) * 100 }}ms;">

    <!-- Identificador sutil del número de elemento -->
    <div class="flex justify-between items-center mb-4">
        <span class="text-xs font-semibold text-purple-400 uppercase tracking-widest font-outfit">
            Elemento #{{ str_pad($gift->id, 2, '0', STR_PAD_LEFT) }}
        </span>
    </div>

    <!-- Contenido principal -->
    <div class="mb-6">
        <h3 class="text-xl md:text-2xl font-bold text-white mb-2 leading-tight font-outfit">
            {{ $gift->name }}
        </h3>
        <p class="text-gray-300 text-sm leading-relaxed font-light">
            {{ $gift->description }}
        </p>
    </div>
    
    <!-- Sección de Estado o Acción -->
    <div class="pt-4 border-t border-purple-500/20 mt-auto">
        @if($gift->guest_id)
            <!-- Indicador de reservado -->
            <div class="w-full py-3.5 bg-[#0a0c10] text-gray-400 rounded-2xl text-center font-bold uppercase tracking-wider text-xs border border-gray-800 flex items-center justify-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Obsequio Reservado
            </div>
        @else
            <!-- Botón con efecto de barrido sólido de izquierda a derecha -->
            <button 
                type="button"
                data-gift-id="{{ $gift->id }}"
                data-gift-name="{{ $gift->name }}"
                class="js-gift-btn relative overflow-hidden w-full py-3.5 bg-[#FF7518] text-white rounded-2xl font-bold uppercase tracking-wider text-xs text-center shadow-[0_4px_15px_rgba(255,117,24,0.3)] hover:shadow-[0_4px_25px_rgba(124,58,237,0.4)] cursor-pointer touch-manipulation select-none [-webkit-tap-highlight-color:transparent] transform active:scale-[0.98] group">
                
                <!-- Capa deslizante de color sólido (Morado) que hace el barrido -->
                <span class="absolute inset-0 bg-[#7C3AED] transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-out z-0"></span>
                
                <!-- Texto del botón asegurando que siempre esté por encima de la capa -->
                <span class="relative z-10">Elegir este Regalo</span>
            </button>
        @endif
    </div>
</div>