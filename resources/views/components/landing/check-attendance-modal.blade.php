<div 
    x-data="{ showCheckModal: {{ session('query_success') || session('query_error') ? 'true' : 'false' }} }" 
    @open-check-modal.window="showCheckModal = true"
    x-show="showCheckModal" 
    class="fixed inset-0 z-[100] flex items-center justify-center p-4 sm:p-6"
    x-cloak
>
    <!-- Overlay oscuro -->
    <div 
        x-show="showCheckModal" 
        x-transition.opacity.duration.300ms 
        @click="showCheckModal = false"
        class="fixed inset-0 bg-black/80 backdrop-blur-sm">
    </div>

    <!-- Contenedor con resplandor y borde morado -->
    <div 
        x-show="showCheckModal" 
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-8 scale-95"
        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
        x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
        x-transition:leave-end="opacity-0 translate-y-8 scale-95"
        class="relative w-full max-w-md bg-[#15181f] border border-purple-500/30 rounded-2xl shadow-[0_0_30px_rgba(139,92,246,0.15)] overflow-hidden z-10">
        
        <!-- Botón Cerrar (Morado al hover) -->
        <button @click="showCheckModal = false" class="absolute top-4 right-4 text-gray-500 hover:text-purple-400 transition-colors">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        </button>

        <div class="p-6 sm:p-8">
            <div class="text-center mb-6">
                <h3 class="font-nightmare text-4xl text-[#FF7518] mb-2 tracking-wide">Consultar Asistencia</h3>
                <p class="text-sm text-gray-300">Ingresa tu número de teléfono para recordar el obsequio que seleccionaste.</p>
            </div>

            <!-- Formulario -->
            <form action="{{ route('attendance.check') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <!-- Focus en morado -->
                    <input type="tel" name="phone" id="phone" required
                        class="w-full bg-[#0f1115] border border-gray-700 rounded-lg px-4 py-3 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all placeholder-gray-600 text-gray-100"
                        placeholder="Ej: 3001234567">
                </div>

                <button type="submit" 
                    class="w-full bg-[#FF7518] hover:bg-[#e66a15] text-white font-bold tracking-wider uppercase rounded-lg px-4 py-3 transition-colors shadow-lg shadow-[#FF7518]/20">
                    Buscar Regalo
                </button>
            </form>

            <!-- Resultados -->
            @if(session('query_success'))
                <div class="mt-6 p-4 bg-[#0f1115] border border-green-500/30 rounded-xl text-center animate-fade-in">
                    <p class="text-gray-300 text-sm">Hola, <span class="font-bold text-white">{{ session('query_success')['name'] }}</span></p>
                    
                    <!-- Insignia visual de Confirmado -->
                    <div class="inline-flex items-center justify-center gap-1.5 bg-green-500/10 text-green-400 px-4 py-1.5 rounded-full text-xs font-bold uppercase tracking-widest mt-3 border border-green-500/20 shadow-[0_0_15px_rgba(34,197,94,0.1)]">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Confirmado
                    </div>

                    <div class="mt-4 pt-3 border-t border-purple-500/20">
                        <p class="text-xs text-purple-400/80 uppercase tracking-widest mb-1">Tu regalo es</p>
                        <p class="font-bold text-[#FF7518] text-xl drop-shadow-md">{{ session('query_success')['gifts'] }}</p>
                    </div>
                </div>
            @endif

            @if(session('query_error'))
                <div class="mt-6 p-4 bg-red-900/20 border border-red-500/30 rounded-xl text-center animate-fade-in">
                    <p class="text-red-400 text-sm font-medium">{{ session('query_error') }}</p>
                </div>
            @endif
        </div>
    </div>
</div>