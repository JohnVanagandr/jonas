<div x-show="modalOpen" 
     x-init="@if(session('success') || session('error')) modalOpen = true @endif"
     class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm" 
     x-cloak style="display: none;"
     x-transition:enter="transition ease-out duration-300" 
     x-transition:enter-start="opacity-0 scale-95" 
     x-transition:enter-end="opacity-100 scale-100" 
     x-transition:leave="transition ease-in duration-200" 
     x-transition:leave-start="opacity-100 scale-100" 
     x-transition:leave-end="opacity-0 scale-95">
    
    <div @click.outside="closeModalFromOutside()" class="bg-[#15181f] border border-gray-800 rounded-[2rem] p-10 max-w-lg w-full mx-4 shadow-2xl relative overflow-hidden">
        
        @if(session('success'))
            <!-- ESTADO DE ÉXITO -->
            <div class="text-center animate-fade-in relative z-10">
                <h3 class="font-nightmare text-4xl text-[#FF7518] mb-4 tracking-wide">¡Asistencia confirmada!</h3>
                
                <div class="inline-flex items-center justify-center gap-1.5 bg-green-500/10 text-green-400 px-5 py-2 rounded-full text-sm font-bold uppercase tracking-widest mb-6 border border-green-500/20 shadow-[0_0_15px_rgba(34,197,94,0.1)]">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Asistencia Confirmada
                </div>
                
                <p class="text-gray-300 text-lg mb-8">{{ session('success') }}</p>
                
                <button type="button" @click="modalOpen = false" class="w-full py-4 bg-[#FF7518] hover:bg-[#e66a15] text-white font-bold tracking-widest uppercase rounded-2xl text-sm transition-colors shadow-lg shadow-[#FF7518]/20">
                    Cerrar
                </button>
            </div>
        @elseif(session('error'))
            <!-- ESTADO DE ERROR -->
            <div class="text-center animate-fade-in relative z-10">
                <h3 class="font-nightmare text-4xl text-red-500 mb-4 tracking-wide">Algo salió mal</h3>
                <p class="text-gray-300 text-lg mb-8">{{ session('error') }}</p>
                <button type="button" @click="modalOpen = false" class="w-full py-4 bg-gray-700 hover:bg-gray-600 text-white font-bold tracking-widest uppercase rounded-2xl text-sm transition-colors">
                    Cerrar y reintentar
                </button>
            </div>
        @else
            <!-- FORMULARIO NORMAL -->
            <div class="mb-8 relative z-10">
                <!-- Título actualizado con la tipografía de la temática -->
                <h3 class="font-nightmare text-4xl text-[#FF7518] mb-2 tracking-wide">Confirmar Asistencia</h3>
                <p class="text-gray-400 text-base">Has seleccionado: <br><strong x-text="selectedGiftName" class="text-[#FF7518]"></strong></p>
            </div>
            
            <form action="{{ route('rsvp.confirm') }}" method="POST" @submit="isSubmitting = true" class="relative z-10">
                @csrf
                <input type="hidden" name="gift_id" x-model="selectedGiftId">
                
                <div class="space-y-6 mb-10">
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest ml-2 mb-2">Nombre Completo</label>
                        <input type="text" name="name" required class="w-full bg-[#0f1115] border border-gray-700 rounded-2xl focus:border-[#FF7518] focus:ring-1 focus:ring-[#FF7518] text-white px-5 py-4 text-lg transition-colors outline-none" placeholder="Ej. Juan Pérez">
                    </div>
                    
                    <div>
                        <label class="block text-xs font-bold text-gray-500 uppercase tracking-widest ml-2 mb-2">Número de Celular</label>
                        <input type="tel" name="phone" required class="w-full bg-[#0f1115] border border-gray-700 rounded-2xl focus:border-[#FF7518] focus:ring-1 focus:ring-[#FF7518] text-white px-5 py-4 text-lg transition-colors outline-none" placeholder="Ej. 300 123 4567">
                    </div>
                </div>
                
                <div class="flex flex-col gap-3">
                    <button type="submit" 
                            :disabled="isSubmitting" 
                            @click="playClick()" 
                            class="w-full py-4 bg-[#FF7518] hover:bg-[#e66a15] text-white font-bold tracking-widest uppercase rounded-2xl text-sm transition-colors disabled:opacity-50 disabled:cursor-not-allowed">
                        <span x-show="!isSubmitting">Asegurar mi Dulce</span>
                        <span x-show="isSubmitting" x-cloak>Confirmar regalo...</span>
                    </button>
                    <button type="button" 
                            @click="modalOpen = false" 
                            :disabled="isSubmitting"
                            class="w-full py-4 bg-transparent text-gray-500 hover:text-white font-bold tracking-widest uppercase rounded-2xl text-sm transition-colors disabled:opacity-50">
                        Cancelar
                    </button>
                </div>
            </form>
        @endif
    </div>
</div>