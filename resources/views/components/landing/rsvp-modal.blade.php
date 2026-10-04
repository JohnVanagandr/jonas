<div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm" x-cloak style="display: none;"
     x-transition:enter="transition ease-out duration-300" 
     x-transition:enter-start="opacity-0 scale-95" 
     x-transition:enter-end="opacity-100 scale-100" 
     x-transition:leave="transition ease-in duration-200" 
     x-transition:leave-start="opacity-100 scale-100" 
     x-transition:leave-end="opacity-0 scale-95">
    
    <div @click.outside="closeModalFromOutside()" class="bg-[#15181f] border border-gray-800 rounded-[2rem] p-10 max-w-lg w-full mx-4 shadow-2xl relative overflow-hidden">
        
        <div class="mb-8 relative z-10">
            <h3 class="text-3xl font-bold text-white mb-2">Confirmar Asistencia</h3>
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
                    <span x-show="isSubmitting" x-cloak>Sellando pacto...</span>
                </button>
                <button type="button" 
                        @click="modalOpen = false" 
                        :disabled="isSubmitting"
                        class="w-full py-4 bg-transparent text-gray-500 hover:text-white font-bold tracking-widest uppercase rounded-2xl text-sm transition-colors disabled:opacity-50">
                    Cancelar
                </button>
            </div>
        </form>
    </div>
</div>