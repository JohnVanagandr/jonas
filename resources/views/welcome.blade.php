<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Baby Shower - Jonas Samuel</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-creepster { font-family: 'Creepster', system-ui; }
        .font-outfit { font-family: 'Outfit', sans-serif; }
        
        /* Auroras Moradas */
        @keyframes aurora {
            0%, 100% { transform: scale(1) translate(0, 0); opacity: 0.15; }
            50% { transform: scale(1.2) translate(-2%, 2%); opacity: 0.3; }
        }
        .animate-aurora { animation: aurora 15s ease-in-out infinite alternate; }

        /* Estrellas Elegantes */
        .stardust {
            position: fixed;
            background: white;
            border-radius: 50%;
            box-shadow: 0 0 10px 2px rgba(168, 85, 247, 0.4);
            pointer-events: none;
            animation: float-magic linear infinite;
        }
        @keyframes float-magic {
            0% { transform: translateY(100vh) scale(0) rotate(0deg); opacity: 0; }
            20% { opacity: 0.6; }
            80% { opacity: 0.6; }
            100% { transform: translateY(-10vh) scale(1.5) rotate(360deg); opacity: 0; }
        }
    </style>
</head>
<body class="bg-[#05010a] text-gray-200 font-outfit antialiased selection:bg-purple-600 selection:text-white relative min-h-screen overflow-x-hidden" 
      x-data="{ 
          modalOpen: false, 
          selectedGiftId: null, 
          selectedGiftName: '',
          musicPlaying: false,
          playHover() { $refs.hoverSfx.currentTime = 0; $refs.hoverSfx.play().catch(()=>{}); },
          playClick() { $refs.clickSfx.currentTime = 0; $refs.clickSfx.play().catch(()=>{}); },
          toggleMusic() { 
              if(this.musicPlaying) { $refs.bgMusic.pause(); } 
              else { $refs.bgMusic.play().catch(()=>{}); } 
              this.musicPlaying = !this.musicPlaying; 
          }
      }">

    <audio x-ref="bgMusic" loop preload="auto"><source src="{{ asset('sounds/lullaby.mp3') }}" type="audio/mpeg"></audio>
    <audio x-ref="hoverSfx" preload="auto"><source src="{{ asset('sounds/hover.mp3') }}" type="audio/mpeg"></audio>
    <audio x-ref="clickSfx" preload="auto"><source src="{{ asset('sounds/click.mp3') }}" type="audio/mpeg"></audio>

    <!-- Polvo de estrellas -->
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="stardust w-1 h-1 left-[15%]" style="animation-duration: 12s; animation-delay: 1s;"></div>
        <div class="stardust w-2 h-2 left-[35%]" style="animation-duration: 15s; animation-delay: 4s;"></div>
        <div class="stardust w-1.5 h-1.5 left-[55%]" style="animation-duration: 10s; animation-delay: 2s;"></div>
        <div class="stardust w-2.5 h-2.5 left-[75%]" style="animation-duration: 14s; animation-delay: 0s;"></div>
        <div class="stardust w-1 h-1 left-[90%]" style="animation-duration: 18s; animation-delay: 3s;"></div>
    </div>

    <!-- Fondo de Auroras Moradas -->
    <div class="fixed inset-0 z-[-2] bg-[#05010a]"></div>
    <div class="fixed top-[-10%] left-[-10%] w-[60vw] h-[60vw] bg-[#4A0E4E]/20 rounded-full blur-[120px] pointer-events-none animate-aurora"></div>
    <div class="fixed bottom-[-10%] right-[-10%] w-[50vw] h-[50vw] bg-[#7e22ce]/15 rounded-full blur-[100px] pointer-events-none animate-aurora" style="animation-delay: -5s;"></div>

    <!-- Controles -->
    <div class="absolute top-6 right-6 z-50 flex items-center gap-6">
        <button @click="toggleMusic()" class="group text-gray-400 hover:text-purple-300 transition-colors flex items-center gap-2 text-sm font-semibold tracking-wide bg-white/5 px-4 py-2 rounded-full border border-white/5 hover:border-purple-500/50 backdrop-blur-md">
            <svg x-show="!musicPlaying" class="w-5 h-5 group-hover:text-purple-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M18.364 5.636a9 9 0 010 12.728M5 15l7-7v12l-7-7H2v-4h3z"></path></svg>
            <svg x-show="musicPlaying" x-cloak class="w-5 h-5 text-purple-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
            <span x-text="musicPlaying ? 'Pausar Magia' : 'Encender Magia'"></span>
        </button>
        @auth
            <a href="{{ route('admin.dashboard') }}" class="text-purple-400 hover:text-white font-bold text-xs tracking-widest uppercase transition-colors duration-300">Panel del Rey</a>
        @endauth
    </div>

    <!-- Hero Section -->
    <header class="relative flex flex-col items-center justify-center pt-32 pb-20 text-center px-4">
        <div class="inline-flex items-center gap-2 px-5 py-2 rounded-full bg-[#1c082e]/50 border border-purple-500/20 text-purple-300 text-xs font-bold tracking-widest uppercase mb-8 backdrop-blur-md shadow-[0_0_15px_rgba(147,51,234,0.2)]">
            Un Dulce Misterio Está por Nacer
        </div>
        
        <h1 class="font-creepster text-5xl md:text-7xl lg:text-8xl text-transparent bg-clip-text bg-gradient-to-b from-white to-purple-200 drop-shadow-lg mb-2">
            Baby Shower de
        </h1>
        <h2 class="font-creepster text-6xl md:text-9xl text-transparent bg-clip-text bg-gradient-to-br from-[#c084fc] via-[#9333ea] to-[#4c1d95] drop-shadow-[0_0_30px_rgba(147,51,234,0.4)] mb-8 transform hover:scale-105 transition-transform duration-700">
            Jonas Samuel
        </h2>
    </header>

    <!-- Detalles del Evento (Glassmorphism Puro) -->
    <section class="max-w-5xl mx-auto px-4 pb-24 relative z-10">
        <div class="bg-[#0f0518]/60 backdrop-blur-xl border border-purple-900/40 rounded-3xl p-8 md:p-12 shadow-[0_20px_50px_rgba(0,0,0,0.5)]">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-4 text-center divide-y md:divide-y-0 md:divide-x divide-purple-900/30">
                
                <div class="px-4 flex flex-col items-center">
                    <div class="w-14 h-14 rounded-2xl bg-[#1c082e] border border-purple-500/20 flex items-center justify-center mb-5 shadow-lg">
                        <svg class="w-6 h-6 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="font-creepster text-3xl text-purple-100 tracking-wider mb-2">El Día Señalado</h4>
                    <p class="text-gray-400 font-light">Domingo,<br>01 de Noviembre</p>
                </div>

                <div class="px-4 flex flex-col items-center pt-8 md:pt-0">
                    <div class="w-14 h-14 rounded-2xl bg-[#1c082e] border border-purple-500/20 flex items-center justify-center mb-5 shadow-lg">
                        <svg class="w-6 h-6 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h4 class="font-creepster text-3xl text-purple-100 tracking-wider mb-2">El Punto de Encuentro</h4>
                    <p class="text-gray-400 font-light leading-relaxed">
                        Sede social del SENA<br>
                        <span class="text-xs text-purple-400">Kilómetro 7, Vía al Palenque<br>Rincón de Girón, Santander</span>
                    </p>
                </div>

                <div class="px-4 flex flex-col items-center pt-8 md:pt-0">
                    <div class="w-14 h-14 rounded-2xl bg-[#1c082e] border border-purple-500/20 flex items-center justify-center mb-5 shadow-lg">
                        <svg class="w-6 h-6 text-purple-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01"></path></svg>
                    </div>
                    <h4 class="font-creepster text-3xl text-purple-100 tracking-wider mb-2">Código de Magia</h4>
                    <p class="text-gray-400 font-light leading-relaxed">
                        Se solicita asistir con <span class="text-purple-400 font-medium">disfraz o antifaz</span>.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Regalos (La Cuadrícula de 60 elementos) -->
    <main class="max-w-[90rem] mx-auto px-4 pb-32 relative z-10">
        <div class="flex items-center justify-center gap-6 mb-16">
            <div class="h-[1px] bg-gradient-to-r from-transparent via-purple-600 to-transparent w-24 md:w-48"></div>
            <h2 class="font-creepster text-4xl md:text-5xl text-purple-200 tracking-widest text-center">Ofrendas para la Cuna</h2>
            <div class="h-[1px] bg-gradient-to-r from-purple-600 via-purple-600 to-transparent w-24 md:w-48"></div>
        </div>

        <!-- El grid está diseñado para escalar perfectamente con 60 regalos -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6 md:gap-8">
            @foreach($gifts as $gift)
                <div @mouseenter="playHover()" class="group relative rounded-2xl overflow-hidden transition-all duration-500 hover:-translate-y-2 {{ $gift->guest_id ? 'opacity-40 grayscale' : 'bg-[#0f0518] border border-purple-900/50 hover:border-purple-400 hover:shadow-[0_0_30px_rgba(147,51,234,0.2)]' }}">
                    
                    <div class="p-6 md:p-8 flex flex-col h-full justify-between relative z-10">
                        <div>
                            <h3 class="font-creepster text-2xl md:text-3xl mb-3 tracking-wide leading-tight {{ $gift->guest_id ? 'text-gray-500' : 'text-purple-100 group-hover:text-white transition-colors' }}">
                                {{ $gift->name }}
                            </h3>
                            <p class="text-sm text-gray-400 mb-8 font-light leading-relaxed">
                                {{ $gift->description }}
                            </p>
                        </div>
                        
                        @if($gift->guest_id)
                            <div class="w-full py-3 bg-black/40 text-gray-500 border border-white/5 rounded-xl text-center font-semibold tracking-widest uppercase text-xs">
                                Asegurado
                            </div>
                        @else
                            <button 
                                @click="playClick(); modalOpen = true; selectedGiftId = {{ $gift->id }}; selectedGiftName = '{{ addslashes($gift->name) }}'"
                                class="w-full py-3 rounded-xl border border-purple-600/50 font-bold text-white bg-gradient-to-r from-[#2e0942] to-[#4A0E4E] hover:from-[#4A0E4E] hover:to-[#6b21a8] shadow-[0_5px_15px_rgba(107,33,168,0.2)] transition-all duration-300">
                                <span class="tracking-widest uppercase text-xs">Elegir Regalo</span>
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Modal de Confirmación Elegante -->
    <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-[#05010a]/90 backdrop-blur-xl" x-cloak style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
        
        <div @click.away="modalOpen = false" class="bg-[#0f0518] border border-purple-500/30 rounded-3xl p-8 md:p-10 max-w-md w-full shadow-[0_0_60px_rgba(147,51,234,0.3)] relative overflow-hidden">
            
            <div class="text-center mb-8 relative z-10">
                <h3 class="font-creepster text-4xl text-purple-300 mb-2 tracking-widest">Pacto de Cuna</h3>
                <p class="text-gray-400 text-sm font-light">Has elegido asegurar:<br> <strong x-text="selectedGiftName" class="text-white text-xl font-creepster tracking-wider block mt-2"></strong></p>
            </div>
            
            <form action="{{ route('rsvp.confirm') }}" method="POST" class="relative z-10">
                @csrf
                <input type="hidden" name="gift_id" x-model="selectedGiftId">
                
                <div class="space-y-5 mb-8">
                    <div>
                        <label class="text-[10px] font-bold text-purple-400 uppercase tracking-widest ml-2 mb-1 block">Tu Nombre</label>
                        <input type="text" name="name" required class="w-full bg-black/50 border border-purple-900/50 rounded-xl focus:border-purple-400 focus:ring-1 focus:ring-purple-400 text-white px-4 py-3 placeholder-gray-600 transition-all">
                    </div>
                    
                    <div>
                        <label class="text-[10px] font-bold text-purple-400 uppercase tracking-widest ml-2 mb-1 block">Número de Contacto</label>
                        <input type="tel" name="phone" required class="w-full bg-black/50 border border-purple-900/50 rounded-xl focus:border-purple-400 focus:ring-1 focus:ring-purple-400 text-white px-4 py-3 placeholder-gray-600 transition-all">
                    </div>
                </div>
                
                <div class="flex flex-col gap-3">
                    <button type="submit" @click="playClick()" class="w-full py-4 bg-gradient-to-r from-purple-800 to-purple-600 hover:from-purple-700 hover:to-purple-500 text-white font-bold tracking-widest uppercase rounded-xl shadow-[0_0_20px_rgba(147,51,234,0.4)] transform hover:-translate-y-1 transition-all duration-300">
                        Confirmar Ofrenda
                    </button>
                    <button type="button" @click="modalOpen = false" class="w-full py-2 text-gray-500 hover:text-white font-medium text-xs tracking-widest uppercase transition-colors">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>