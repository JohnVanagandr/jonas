@props(['gift', 'index'])

<!-- Tarjeta estilo Contrato / Decreto del Más Allá -->
<div class="reveal-card contract-card relative w-full border-2 border-dashed border-gray-700/70 rounded-3xl p-7 flex flex-col justify-between transition-all duration-300 {{ $gift->guest_id ? 'opacity-50 grayscale border-gray-800' : 'hover:border-[#FF7518]/60 hover:shadow-[0_0_20px_rgba(255,117,24,0.15)]' }}"
     style="--card-delay: {{ ($index % 4) * 100 }}ms;">

    <!-- Contenido del Decreto -->
    <div class="mb-6 pt-2">
        <span class="inline-block text-[#FF7518] text-xs font-bold uppercase tracking-widest mb-2">
            Ofrenda para la Cuna
        </span>
        <h3 class="text-2xl font-bold text-white mb-3 leading-tight font-outfit">
            {{ $gift->name }}
        </h3>
        <p class="text-gray-400 text-sm leading-relaxed font-light min-h-[48px]">
            {{ $gift->description }}
        </p>
    </div>
    
    <!-- Sección de Acción / Estado -->
    <div class="pt-4 border-t border-gray-800/80 mt-auto relative z-30">
        @if($gift->guest_id)
            <div class="w-full py-3.5 bg-[#0a0c10] text-gray-500 rounded-xl text-center font-bold uppercase tracking-wider text-xs border border-gray-800/60">
                Sello Asegurado
            </div>
        @else
            <!-- Sin Alpine: un listener nativo delegado (app.js) atiende click y touchend -->
            <button 
                type="button"
                data-gift-id="{{ $gift->id }}"
                data-gift-name="{{ $gift->name }}"
                class="js-gift-btn w-full py-3.5 bg-transparent border border-[#FF7518]/50 hover:bg-[#FF7518] text-white rounded-xl font-bold uppercase tracking-wider text-xs transition-colors duration-300 text-center shadow-md relative cursor-pointer touch-manipulation select-none [-webkit-tap-highlight-color:transparent]">
                Sellar Pacto (Elegir)
            </button>
        @endif
    </div>
</div>