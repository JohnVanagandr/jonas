<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Baby Shower - El Extraño Mundo de Jonas Samuel</title>
    
    <!-- Fuentes Temáticas Premium -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Cinzel:wght@400;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-creepster { font-family: 'Creepster', system-ui; }
        .font-cinzel { font-family: 'Cinzel', serif; }
        
        /* Animación del fondo */
        @keyframes pulse-glow {
            0%, 100% { opacity: 0.3; }
            50% { opacity: 0.6; }
        }
        .animate-glow { animation: pulse-glow 8s ease-in-out infinite; }

        /* Cenizas/Nieve de Halloween Town flotando */
        .ash {
            position: fixed;
            background: white;
            border-radius: 50%;
            opacity: 0;
            pointer-events: none;
            animation: float-up linear infinite;
        }
        @keyframes float-up {
            0% { transform: translateY(100vh) scale(0); opacity: 0; }
            20% { opacity: 0.5; }
            80% { opacity: 0.5; }
            100% { transform: translateY(-10vh) scale(1.5); opacity: 0; }
        }
    </style>
</head>
<!-- Integramos Alpine.js para controlar modales y audio -->
<body class="bg-black text-gray-200 font-cinzel antialiased selection:bg-[#FF7518] selection:text-white relative min-h-screen overflow-x-hidden" 
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

    <!-- Pistas de Audio (Referencias para Alpine) -->
    <!-- Nota: Crea la carpeta public/sounds/ y coloca tus archivos .mp3 allí -->
    <audio x-ref="bgMusic" loop preload="auto">
        <source src="{{ asset('sounds/lullaby.mp3') }}" type="audio/mpeg">
    </audio>
    <audio x-ref="hoverSfx" preload="auto">
        <source src="{{ asset('sounds/hover.mp3') }}" type="audio/mpeg">
    </audio>
    <audio x-ref="clickSfx" preload="auto">
        <source src="{{ asset('sounds/click.mp3') }}" type="audio/mpeg">
    </audio>

    <!-- Partículas de Ceniza CSS (Generadas estáticamente para no saturar) -->
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="ash w-2 h-2 left-[10%]" style="animation-duration: 12s; animation-delay: 1s;"></div>
        <div class="ash w-3 h-3 left-[25%]" style="animation-duration: 15s; animation-delay: 4s;"></div>
        <div class="ash w-1 h-1 left-[40%]" style="animation-duration: 10s; animation-delay: 2s;"></div>
        <div class="ash w-2 h-2 left-[60%]" style="animation-duration: 14s; animation-delay: 0s;"></div>
        <div class="ash w-3 h-3 left-[80%]" style="animation-duration: 18s; animation-delay: 3s;"></div>
        <div class="ash w-1 h-1 left-[90%]" style="animation-duration: 11s; animation-delay: 5s;"></div>
    </div>

    <!-- Fondo Inmersivo -->
    <div class="fixed inset-0 z-[-2] bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-[#1a0530] via-black to-black"></div>
    <div class="fixed inset-0 z-[-2] bg-[url('https://www.transparenttextures.com/patterns/stardust.png')] opacity-20 pointer-events-none animate-glow"></div>

    <!-- Controles Superiores: Admin y Audio -->
    <div class="absolute top-6 right-6 z-50 flex items-center gap-6">
        <button @click="toggleMusic()" class="text-gray-400 hover:text-[#FF7518] transition-colors flex items-center gap-2 text-sm tracking-widest outline-none">
            <svg x-show="!musicPlaying" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M18.364 5.636a9 9 0 010 12.728M5 15l7-7v12l-7-7H2v-4h3z"></path></svg>
            <svg x-show="musicPlaying" x-cloak class="w-5 h-5 text-[#9b59b6] animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
            <span x-text="musicPlaying ? 'Pausar Melodía' : 'Despertar la Cuna'"></span>
        </button>

        @auth
            <a href="{{ route('admin.dashboard') }}" class="text-[#FF7518] hover:text-white font-bold text-xs tracking-[0.2em] uppercase transition-colors duration-300">Panel del Rey</a>
        @else
            <a href="{{ route('login') }}" class="text-white/10 hover:text-white/40 text-xs tracking-widest transition-colors duration-300">Acceso</a>
        @endauth
    </div>

    <!-- Alertas Flotantes -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed top-20 left-1/2 -translate-x-1/2 z-50 bg-[#2a0845]/90 backdrop-blur-md border border-[#9b59b6] text-white px-8 py-4 rounded-full shadow-[0_0_20px_rgba(155,89,182,0.6)] flex items-center gap-3">
            <span class="font-bold tracking-wider">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed top-20 left-1/2 -translate-x-1/2 z-50 bg-red-950/90 backdrop-blur-md border border-red-600 text-white px-8 py-4 rounded-full shadow-[0_0_20px_rgba(220,38,38,0.6)] flex items-center gap-3">
            <span class="font-bold tracking-wider">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Enlace discreto de administración -->
    <div class="absolute top-4 right-4 z-50">
        @auth
            <a href="{{ route('admin.dashboard') }}" class="text-[#FF7518] hover:text-white font-bold text-sm tracking-widest transition">Panel del Rey Calabaza</a>
        @else
            <a href="{{ route('login') }}" class="text-gray-900 hover:text-gray-700 text-xs transition">Acceso</a>
        @endauth
    </div>
    <!-- Hero Section -->
    <header class="relative flex flex-col items-center justify-center min-h-[75vh] text-center px-4">
        <div class="absolute w-72 h-72 bg-purple-900/20 rounded-full blur-[120px] pointer-events-none"></div>
        
        <p class="text-[#9b59b6] font-bold tracking-[0.4em] uppercase text-sm mb-4 animate-pulse">Un Baby Shower de Pesadilla</p>
        
        <h1 class="font-creepster text-6xl md:text-8xl lg:text-9xl text-transparent bg-clip-text bg-gradient-to-b from-gray-100 to-gray-500 drop-shadow-[0_0_15px_rgba(255,255,255,0.1)] mb-2">
            El Extraño Mundo de
        </h1>
        <h2 class="font-creepster text-7xl md:text-9xl text-transparent bg-clip-text bg-gradient-to-b from-[#FF7518] to-[#8b3d0c] drop-shadow-[0_0_20px_rgba(255,117,24,0.4)] mb-8 transform hover:scale-105 transition-transform duration-700">
            Jonas Samuel
        </h2>
        
        <p class="text-lg md:text-xl max-w-2xl text-gray-400 tracking-wide font-light leading-relaxed">
            El Rey Calabaza ha preparado la cuna. Acompáñanos a celebrar la llegada de nuestro pequeño monstruito a este mundo. Sella tu destino y elige un presente.
        </p>
    </header>

    <!-- Sección de Regalos -->
    <main class="max-w-7xl mx-auto px-4 py-16 pb-32 relative z-10">
        <div class="flex items-center justify-center gap-4 mb-16">
            <div class="h-px bg-gradient-to-r from-transparent via-purple-500 to-transparent w-32"></div>
            <h2 class="font-creepster text-4xl text-gray-200 tracking-widest text-center">Tesoros para la Cuna de Jonas</h2>
            <div class="h-px bg-gradient-to-r from-purple-500 via-purple-500 to-transparent w-32"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($gifts as $gift)
                <div @mouseenter="playHover()" class="group relative rounded-2xl overflow-hidden backdrop-blur-md border transition-all duration-500 {{ $gift->guest_id ? 'bg-black/40 border-white/5 opacity-60 grayscale' : 'bg-white/5 border-white/10 hover:border-[#FF7518]/50 hover:shadow-[0_0_30px_rgba(255,117,24,0.15)] hover:-translate-y-2' }}">
                    
                    <div class="p-8">
                        <h3 class="font-creepster text-3xl mb-3 tracking-wide {{ $gift->guest_id ? 'text-gray-600' : 'text-gray-100 group-hover:text-[#FF7518] transition-colors' }}">
                            {{ $gift->name }}
                        </h3>
                        <p class="text-sm text-gray-400 mb-8 h-16 leading-relaxed font-light">
                            {{ $gift->description }}
                        </p>
                        
                        @if($gift->guest_id)
                            <div class="flex items-center justify-center w-full py-3 bg-black/50 text-gray-600 border border-white/5 rounded-xl text-sm tracking-widest cursor-not-allowed">
                                Ya invocado por un Espectro
                            </div>
                        @else
                            <button 
                                @click="playClick(); modalOpen = true; selectedGiftId = {{ $gift->id }}; selectedGiftName = '{{ addslashes($gift->name) }}'"
                                class="w-full py-3 bg-transparent border border-[#9b59b6] hover:bg-[#9b59b6] text-white rounded-xl text-sm tracking-widest font-bold transition-all duration-300 relative overflow-hidden">
                                Ofrendar a Jonas
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Modal de Confirmación -->
    <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-md" x-cloak style="display: none;" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
        <div @click.away="modalOpen = false" class="bg-[#11051c]/95 backdrop-blur-xl border border-purple-900/50 rounded-2xl p-10 max-w-md w-full shadow-[0_0_50px_rgba(74,14,78,0.5)] relative overflow-hidden">
            
            <div class="absolute top-0 right-0 w-32 h-32 bg-[#FF7518]/10 rounded-full blur-[50px] pointer-events-none"></div>

            <h3 class="font-creepster text-4xl text-[#FF7518] mb-2 tracking-widest text-center">Pacto de Bienvenida</h3>
            <p class="text-center text-sm text-gray-400 mb-8">Estás a punto de asegurar para Jonas:<br> <strong x-text="selectedGiftName" class="text-gray-200 text-lg font-creepster tracking-wider"></strong></p>
            
            <form action="{{ route('rsvp.confirm') }}" method="POST">
                @csrf
                <input type="hidden" name="gift_id" x-model="selectedGiftId">
                
                <div class="mb-5 relative">
                    <input type="text" name="name" required class="w-full bg-black/50 border-b border-gray-700 border-t-0 border-x-0 focus:border-[#FF7518] focus:ring-0 text-gray-200 p-3 placeholder-gray-600 transition-colors" placeholder="Tu Nombre Terrenal">
                </div>
                
                <div class="mb-10 relative">
                    <input type="tel" name="phone" required class="w-full bg-black/50 border-b border-gray-700 border-t-0 border-x-0 focus:border-[#FF7518] focus:ring-0 text-gray-200 p-3 placeholder-gray-600 transition-colors" placeholder="Teléfono (Identificador Único)">
                </div>
                
                <div class="flex flex-col gap-3">
                    <button type="submit" @click="playClick()" class="w-full py-4 bg-gradient-to-r from-[#4A0E4E] to-[#9b59b6] hover:from-[#FF7518] hover:to-[#8b3d0c] text-white font-bold tracking-widest rounded-xl shadow-lg transition-all transform hover:scale-[1.02]">
                        Confirmar Asistencia
                    </button>
                    <button type="button" @click="modalOpen = false" class="w-full py-3 text-gray-500 hover:text-gray-300 text-sm tracking-widest transition-colors">
                        Cancelar invocación
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>