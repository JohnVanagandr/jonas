<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Panel del Rey Calabaza') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <!-- Tarjetas de Estadísticas -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                
                <!-- Tarjeta 1: Espectros Confirmados -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-purple-600">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <div class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Almas Confirmadas</div>
                            <div class="text-4xl font-black text-gray-800">{{ $totalGuests }}</div>
                        </div>
                        <div class="text-purple-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta 2: Regalos Reclamados -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-orange-500">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <div class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Regalos Reclamados</div>
                            <div class="text-4xl font-black text-gray-800">{{ $claimedGifts }} <span class="text-lg text-gray-400 font-normal">/ {{ $totalGifts }}</span></div>
                        </div>
                        <div class="text-orange-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Tarjeta 3: Regalos Disponibles -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 border-l-4 border-green-500">
                    <div class="flex items-center">
                        <div class="flex-1">
                            <div class="text-gray-500 text-xs font-bold uppercase tracking-wider mb-1">Regalos Disponibles</div>
                            <div class="text-4xl font-black text-gray-800">{{ $totalGifts - $claimedGifts }}</div>
                        </div>
                        <div class="text-green-300">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Panel Informativo -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex items-center gap-4">
                    <svg class="w-8 h-8 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <p>
                        <strong>El panorama está claro.</strong> Desde aquí puedes monitorear el progreso de las confirmaciones. 
                        Navega a la sección de <a href="{{ route('admin.guests.index') }}" class="text-purple-600 font-bold hover:underline">Invitados</a> para ver el detalle de cada alma o a la sección de <a href="{{ route('admin.gifts.index') }}" class="text-purple-600 font-bold hover:underline">Regalos</a> para forjar nuevos elementos.
                    </p>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>