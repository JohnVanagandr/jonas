@props(['gift', 'index'])

@php
    $isSoldOut = $gift->is_sold_out;
@endphp

<!-- Añadimos h-full y grid-rows-[auto_1fr_auto] para alinear perfectamente todas las tarjetas -->
<div class="reveal-card relative h-full w-full bg-[#12141c] border {{ $isSoldOut ? 'opacity-60 grayscale-[20%] border-gray-900' : 'border-purple-500/20 hover:border-purple-500/60 hover:shadow-[0_0_25px_rgba(139,92,246,0.2)]' }} rounded-3xl p-6 md:p-7 grid grid-rows-[auto_1fr_auto] gap-5 transition-all duration-300 shadow-xl"
     style="--card-delay: {{ ($index % 4) * 100 }}ms;">

    <!-- Fila 1: Identificador -->
    <div class="flex justify-between items-center">
        <span class="text-xs font-semibold text-purple-400 uppercase tracking-widest font-outfit">
            Elemento #{{ str_pad($gift->id, 2, '0', STR_PAD_LEFT) }}
        </span>
    </div>

    <!-- Fila 2: Contenido Principal -->
    <div class="flex flex-col h-full">
        <h3 class="text-xl md:text-2xl font-bold text-white mb-2 leading-tight font-outfit">
            {{ $gift->name }}
        </h3>
        
        <p class="text-gray-400 text-sm leading-relaxed font-light">
            {{ $gift->description }}
        </p>
    </div>
    
    <!-- Fila 3: Acción Compartida (UI/UX Optimizado) -->
    <div class="pt-5 border-t border-purple-500/20 mt-auto">
        @if($isSoldOut)
            <!-- Indicador de reservado -->
            <div class="w-full h-12 bg-[#0a0c10] text-gray-500 rounded-xl text-center font-bold uppercase tracking-wider text-xs border border-gray-800 flex items-center justify-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Obsequio Reservado
            </div>
        @else
            <!-- Contenedor Flex para compartir el espacio de los botones -->
            <div class="flex items-center gap-2.5 w-full">
                
                @if($gift->url)
                    <!-- Botón de Soporte: Ver Ejemplo (Fijo, oscuro y con texto corto explícito) -->
                    <a href="{{ $gift->url }}" target="_blank" rel="noopener noreferrer" 
                       class="flex items-center justify-center gap-1.5 px-4 h-12 bg-[#1a1d27] border border-gray-700/60 hover:border-purple-500/50 hover:bg-[#252936] rounded-xl text-gray-300 hover:text-white transition-all shadow-sm shrink-0 group/link"
                       title="Ver foto de referencia">
                        <svg class="w-5 h-5 text-purple-400 group-hover/link:text-[#FF7518] transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        <span class="text-xs font-bold tracking-wide">Foto</span>
                    </a>
                @endif
                
                <!-- Botón Principal: Elegir (Flexible, ocupa el resto del espacio) -->
                <button 
                    type="button"
                    data-gift-id="{{ $gift->id }}"
                    data-gift-name="{{ $gift->name }}"
                    class="js-gift-btn relative overflow-hidden flex-1 h-12 flex items-center justify-center bg-[#FF7518] text-white rounded-xl font-bold uppercase tracking-wider text-[11px] sm:text-xs text-center shadow-[0_4px_15px_rgba(255,117,24,0.3)] hover:shadow-[0_4px_25px_rgba(124,58,237,0.4)] cursor-pointer touch-manipulation select-none [-webkit-tap-highlight-color:transparent] transform active:scale-[0.98] group">
                    
                    <span class="absolute inset-0 bg-[#7C3AED] transform -translate-x-full group-hover:translate-x-0 transition-transform duration-300 ease-out z-0"></span>
                    <span class="relative z-10 w-full px-1 truncate">Seleccionar</span>
                </button>
                
            </div>
        @endif
    </div>
</div>