@props(['gift', 'index'])

<!-- Tarjeta minimalista, limpia y elegante -->
<div class="reveal-card relative w-full bg-[#12141c] border border-gray-800/80 rounded-3xl p-6 md:p-7 flex flex-col justify-between transition-all duration-300 shadow-xl {{ $gift->guest_id ? 'opacity-60 grayscale-[20%] border-gray-900' : 'hover:border-[#FF7518]/40 hover:shadow-[0_0_20px_rgba(255,117,24,0.1)]' }}"
     style="--card-delay: {{ ($index % 4) * 100 }}ms;">

    <!-- Identificador sutil del número de elemento -->
    <div class="flex justify-between items-center mb-4">
        <span class="text-xs font-medium text-gray-500 uppercase tracking-widest font-outfit">
            Elemento #{{ str_pad($gift->id, 2, '0', STR_PAD_LEFT) }}
        </span>
    </div>

    <!-- Contenido principal -->
    <div class="mb-6">
        <h3 class="text-xl md:text-2xl font-bold text-white mb-2 leading-tight font-outfit">
            {{ $gift->name }}
        </h3>
        <p class="text-gray-400 text-sm leading-relaxed font-light">
            {{ $gift->description }}
        </p>
    </div>
    
    <!-- Sección de Estado o Acción -->
    <div class="pt-4 border-t border-gray-800/60 mt-auto">
        @if($gift->guest_id)
            <!-- Indicador claro de que ya fue seleccionado por alguien más -->
            <div class="w-full py-3.5 bg-[#0a0c10] text-gray-400 rounded-2xl text-center font-bold uppercase tracking-wider text-xs border border-gray-800 flex items-center justify-center gap-2">
                <span class="w-2 h-2 rounded-full bg-emerald-500 animate-pulse"></span>
                Obsequio Reservado
            </div>
        @else
            <!-- Botón de acción limpio y funcional -->
            <button 
                type="button"
                data-gift-id="{{ $gift->id }}"
                data-gift-name="{{ $gift->name }}"
                class="js-gift-btn w-full py-3.5 bg-[#FF7518] hover:bg-[#e66a15] text-white rounded-2xl font-bold uppercase tracking-wider text-xs transition-all duration-300 text-center shadow-[0_4px_15px_rgba(255,117,24,0.2)] relative cursor-pointer touch-manipulation select-none [-webkit-tap-highlight-color:transparent] transform active:scale-[0.98]">
                Elegir este Regalo
            </button>
        @endif
    </div>
</div>