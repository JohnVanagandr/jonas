<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>El Extraño Mundo de la Celebración</title>
    
    <!-- Fuentes Temáticas -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Montserrat:wght@400;600&display=swap" rel="stylesheet">
    
    <!-- Tailwind & Alpine (Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-creepster { font-family: 'Creepster', system-ui; }
        .font-montserrat { font-family: 'Montserrat', sans-serif; }
        .bg-halloween { background-color: #121212; }
        .text-bone { color: #F5F5DC; }
    </style>
</head>
<body class="bg-halloween text-bone font-montserrat antialiased selection:bg-[#FF7518] selection:text-white" x-data="{ modalOpen: false, selectedGiftId: null, selectedGiftName: '' }">

    <!-- Hero Section -->
    <header class="relative flex flex-col items-center justify-center min-h-[60vh] text-center px-4 border-b border-[#4A0E4E]">
        <div class="absolute inset-0 bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-30 pointer-events-none"></div>
        <h1 class="font-creepster text-6xl md:text-8xl tracking-widest text-[#FF7518] drop-shadow-lg mb-4">
            Una Noche de Pesadilla
        </h1>
        <p class="text-xl md:text-2xl max-w-2xl text-gray-300">
            Acompáñanos a celebrar en Halloween Town. Confirma tu asistencia eligiendo un presente de nuestra oscura colección.
        </p>
    </header>

    <!-- Sección de Regalos -->
    <main class="max-w-7xl mx-auto px-4 py-16">
        <h2 class="font-creepster text-4xl text-center text-[#9b59b6] mb-12">Nuestra Lista de Deseos</h2>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($gifts as $gift)
                <div class="rounded-xl border border-gray-800 overflow-hidden relative {{ $gift->guest_id ? 'bg-gray-900 opacity-60 grayscale' : 'bg-[#1A1A2E] shadow-[0_0_15px_rgba(74,14,78,0.5)] transition hover:scale-105' }}">
                    
                    <div class="p-6">
                        <h3 class="font-creepster text-3xl mb-2 {{ $gift->guest_id ? 'text-gray-500' : 'text-[#F5F5DC]' }}">
                            {{ $gift->name }}
                        </h3>
                        <p class="text-sm text-gray-400 mb-6 h-12">{{ $gift->description }}</p>
                        
                        @if($gift->guest_id)
                            <div class="flex items-center justify-center w-full py-3 bg-gray-800 text-gray-500 rounded-lg cursor-not-allowed">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                                Reclamado por un Espectro
                            </div>
                        @else
                            <button 
                                @click="modalOpen = true; selectedGiftId = {{ $gift->id }}; selectedGiftName = '{{ addslashes($gift->name) }}'"
                                class="w-full py-3 bg-[#FF7518] hover:bg-[#e66a16] text-black font-bold rounded-lg transition duration-300">
                                Seleccionar este Regalo
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Modal de Confirmación (Alpine.js) -->
    <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm" x-cloak style="display: none;">
        <div @click.away="modalOpen = false" class="bg-[#1A1A2E] border border-[#4A0E4E] rounded-xl p-8 max-w-md w-full shadow-2xl">
            <h3 class="font-creepster text-3xl text-[#FF7518] mb-2">Sellar el Pacto</h3>
            <p class="text-sm text-gray-300 mb-6">Estás a punto de invocar: <strong x-text="selectedGiftName" class="text-[#F5F5DC]"></strong></p>
            
            <form action="{{ route('rsvp.confirm') }}" method="POST">
                @csrf
                <input type="hidden" name="gift_id" x-model="selectedGiftId">
                
                <div class="mb-4">
                    <label class="block text-sm text-gray-400 mb-1">Tu Nombre Terrenal</label>
                    <input type="text" name="name" required class="w-full bg-gray-900 border border-gray-700 rounded p-2 text-white focus:border-[#9b59b6] focus:ring-1 focus:ring-[#9b59b6] outline-none">
                </div>
                
                <div class="mb-8">
                    <label class="block text-sm text-gray-400 mb-1">Teléfono (Identificador Único)</label>
                    <input type="tel" name="phone" required class="w-full bg-gray-900 border border-gray-700 rounded p-2 text-white focus:border-[#9b59b6] focus:ring-1 focus:ring-[#9b59b6] outline-none" placeholder="Ej: 3001234567">
                </div>
                
                <div class="flex justify-end gap-4">
                    <button type="button" @click="modalOpen = false" class="px-4 py-2 text-gray-400 hover:text-white transition">Cancelar</button>
                    <button type="submit" class="px-6 py-2 bg-[#9b59b6] hover:bg-[#8e44ad] text-white font-bold rounded shadow-lg transition">Confirmar Asistencia</button>
                </div>
            </form>
        </div>
    </div>

</body>

<!-- Alertas Flotantes -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="fixed top-5 right-5 z-50 bg-[#4A0E4E] border border-[#9b59b6] text-white px-6 py-4 rounded shadow-[0_0_15px_rgba(155,89,182,0.5)] flex items-center gap-3 transition-opacity duration-500">
            <svg class="w-6 h-6 text-[#FF7518]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <span class="font-bold">{{ session('success') }}</span>
        </div>
    @endif

    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 4000)" class="fixed top-5 right-5 z-50 bg-red-900 border border-red-500 text-white px-6 py-4 rounded shadow-lg flex items-center gap-3 transition-opacity duration-500">
            <svg class="w-6 h-6 text-red-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            <span class="font-bold">{{ session('error') }}</span>
        </div>
    @endif
</html>