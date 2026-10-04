<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Baby Shower - Jonas Samuel</title>
    
    <!-- Fuentes: Creepster (Temática) y Outfit (Moderna, suave y tierna para el bebé) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Outfit:wght@300;400;600;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-creepster { font-family: 'Creepster', system-ui; }
        .font-outfit { font-family: 'Outfit', sans-serif; }
        
        /* Animación del fondo mágico */
        @keyframes aurora {
            0%, 100% { transform: scale(1) translate(0, 0); opacity: 0.2; }
            50% { transform: scale(1.2) translate(-5%, 5%); opacity: 0.4; }
        }
        .animate-aurora { animation: aurora 15s ease-in-out infinite alternate; }

        /* Nieve mágica / Polvo de estrellas */
        .stardust {
            position: fixed;
            background: white;
            border-radius: 50%;
            box-shadow: 0 0 10px 2px rgba(255, 255, 255, 0.4);
            pointer-events: none;
            animation: float-magic linear infinite;
        }
        @keyframes float-magic {
            0% { transform: translateY(100vh) scale(0) rotate(0deg); opacity: 0; }
            20% { opacity: 0.8; }
            80% { opacity: 0.8; }
            100% { transform: translateY(-10vh) scale(1.5) rotate(360deg); opacity: 0; }
        }
        
        /* Efecto de Costura para las Tarjetas (Estilo muñeco de trapo / Sally) */
        .stitched-border {
            outline: 2px dashed rgba(155, 89, 182, 0.4);
            outline-offset: -8px;
        }
    </style>
</head>
<body class="bg-[#0a0310] text-gray-200 font-outfit antialiased selection:bg-[#FF7518] selection:text-white relative min-h-screen overflow-x-hidden" 
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

    <!-- Pistas de Audio -->
    <audio x-ref="bgMusic" loop preload="auto"><source src="{{ asset('sounds/lullaby.mp3') }}" type="audio/mpeg"></audio>
    <audio x-ref="hoverSfx" preload="auto"><source src="{{ asset('sounds/hover.mp3') }}" type="audio/mpeg"></audio>
    <audio x-ref="clickSfx" preload="auto"><source src="{{ asset('sounds/click.mp3') }}" type="audio/mpeg"></audio>

    <!-- Polvo de estrellas CSS -->
    <div class="fixed inset-0 z-[-1] pointer-events-none">
        <div class="stardust w-1.5 h-1.5 left-[15%]" style="animation-duration: 12s; animation-delay: 1s;"></div>
        <div class="stardust w-2 h-2 left-[35%]" style="animation-duration: 15s; animation-delay: 4s;"></div>
        <div class="stardust w-1 h-1 left-[55%]" style="animation-duration: 10s; animation-delay: 2s;"></div>
        <div class="stardust w-2.5 h-2.5 left-[75%]" style="animation-duration: 14s; animation-delay: 0s;"></div>
        <div class="stardust w-1.5 h-1.5 left-[90%]" style="animation-duration: 18s; animation-delay: 3s;"></div>
    </div>

    <!-- Fondo Inmersivo Premium -->
    <div class="fixed inset-0 z-[-2] bg-[#0a0310]"></div>
    <div class="fixed top-[-20%] left-[-10%] w-[70vw] h-[70vw] bg-purple-900/20 rounded-full blur-[120px] pointer-events-none animate-aurora"></div>
    <div class="fixed bottom-[-20%] right-[-10%] w-[60vw] h-[60vw] bg-[#FF7518]/10 rounded-full blur-[100px] pointer-events-none animate-aurora" style="animation-delay: -5s;"></div>

    <!-- Controles Superiores -->
    <div class="absolute top-6 right-6 z-50 flex items-center gap-6">
        <button @click="toggleMusic()" class="group text-gray-400 hover:text-white transition-colors flex items-center gap-2 text-sm font-semibold tracking-wide bg-white/5 px-4 py-2 rounded-full border border-white/10 hover:border-purple-500/50 backdrop-blur-md">
            <svg x-show="!musicPlaying" class="w-5 h-5 group-hover:text-purple-400 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.536 8.464a5 5 0 010 7.072M18.364 5.636a9 9 0 010 12.728M5 15l7-7v12l-7-7H2v-4h3z"></path></svg>
            <svg x-show="musicPlaying" x-cloak class="w-5 h-5 text-purple-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19V6l12-3v13M9 19c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zm12-3c0 1.105-1.343 2-3 2s-3-.895-3-2 1.343-2 3-2 3 .895 3 2zM9 10l12-3"></path></svg>
            <span x-text="musicPlaying ? 'Pausar Magia' : 'Encender Magia'"></span>
        </button>
        @auth
            <a href="{{ route('admin.dashboard') }}" class="text-[#FF7518] hover:text-white font-bold text-xs tracking-widest uppercase transition-colors duration-300">Panel del Rey</a>
        @endauth
    </div>

    <!-- Alertas Flotantes -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed top-24 left-1/2 -translate-x-1/2 z-50 bg-gradient-to-r from-purple-900 to-[#4A0E4E] border border-purple-400 text-white px-8 py-4 rounded-2xl shadow-[0_10px_40px_rgba(155,89,182,0.5)] flex items-center gap-3">
            <span class="font-bold">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed top-24 left-1/2 -translate-x-1/2 z-50 bg-gradient-to-r from-red-900 to-red-950 border border-red-500 text-white px-8 py-4 rounded-2xl shadow-[0_10px_40px_rgba(220,38,38,0.5)] flex items-center gap-3">
            <span class="font-bold">{{ session('error') }}</span>
        </div>
    @endif

    <!-- Hero Section (Ternura + Misterio) -->
    <header class="relative flex flex-col items-center justify-center pt-32 pb-20 text-center px-4">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-purple-900/30 border border-purple-500/30 text-purple-300 text-sm font-bold tracking-widest uppercase mb-6 backdrop-blur-sm">
            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd"></path></svg>
            Un Dulce Terror Está por Nacer
        </div>
        
        <h1 class="font-creepster text-5xl md:text-7xl lg:text-8xl text-transparent bg-clip-text bg-gradient-to-b from-white to-purple-200 drop-shadow-lg mb-2">
            Baby Shower de
        </h1>
        <h2 class="font-creepster text-7xl md:text-9xl text-transparent bg-clip-text bg-gradient-to-br from-[#FF7518] via-[#ff9b54] to-[#8b3d0c] drop-shadow-[0_0_30px_rgba(255,117,24,0.5)] mb-8 transform hover:scale-105 transition-transform duration-700">
            Jonas Samuel
        </h2>
        
        <p class="text-lg md:text-xl max-w-2xl text-gray-300 font-light leading-relaxed">
            La luna brilla sobre Halloween Town y la cuna está casi lista. Acompáñanos a darle la bienvenida a nuestro pequeño monstruito. Selecciona un presente mágico para él.
        </p>
    </header>

    <!-- Detalles del Evento (Tarjetas estilo pergamino moderno) -->
    <section class="max-w-5xl mx-auto px-4 pb-20 relative z-10">
        <div class="bg-[#1a0b29]/60 backdrop-blur-2xl border border-white/10 rounded-[2.5rem] p-8 md:p-12 shadow-[0_20px_50px_rgba(0,0,0,0.5)] relative overflow-hidden stitched-border">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10 md:gap-4 text-center divide-y md:divide-y-0 md:divide-x divide-purple-900/50">
                <!-- Fecha -->
                <div class="px-4 flex flex-col items-center">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-purple-600 to-purple-900 flex items-center justify-center mb-6 shadow-lg shadow-purple-900/50 transform rotate-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    </div>
                    <h4 class="font-creepster text-3xl text-purple-200 tracking-wider mb-2">El Día Señalado</h4>
                    <p class="text-gray-300 font-medium text-lg">Domingo,<br>01 de Noviembre</p>
                </div>

                <!-- Lugar -->
                <div class="px-4 flex flex-col items-center pt-8 md:pt-0">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-[#FF7518] to-orange-800 flex items-center justify-center mb-6 shadow-lg shadow-orange-900/50 transform -rotate-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.243-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h4 class="font-creepster text-3xl text-orange-200 tracking-wider mb-2">Punto de Encuentro</h4>
                    <p class="text-gray-300 font-medium leading-relaxed">
                        Sede social del SENA<br>
                        <span class="text-sm text-gray-400 font-light">Kilómetro 7, Vía al Palenque<br>Rincón de Girón, Santander</span>
                    </p>
                </div>

                <!-- Vestimenta -->
                <div class="px-4 flex flex-col items-center pt-8 md:pt-0">
                    <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-gray-600 to-gray-900 flex items-center justify-center mb-6 shadow-lg shadow-black/50 transform rotate-3">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.618 5.984A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016zM12 9v2m0 4h.01"></path></svg>
                    </div>
                    <h4 class="font-creepster text-3xl text-gray-200 tracking-wider mb-2">Código de Magia</h4>
                    <p class="text-gray-300 font-medium leading-relaxed">
                        Se solicita a los invitados asistir con <span class="text-[#FF7518] font-bold">disfraz o antifaz</span>.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Sección de Regalos (Tarjetas Mágicas) -->
    <main class="max-w-7xl mx-auto px-4 pb-32 relative z-10">
        <div class="flex items-center justify-center gap-6 mb-16">
            <div class="h-[2px] bg-gradient-to-r from-transparent via-purple-500 to-transparent w-24 md:w-48 rounded-full"></div>
            <h2 class="font-creepster text-4xl md:text-5xl text-white tracking-widest text-center drop-shadow-md">Ofrendas para Jonas</h2>
            <div class="h-[2px] bg-gradient-to-r from-purple-500 via-purple-500 to-transparent w-24 md:w-48 rounded-full"></div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @foreach($gifts as $gift)
                <!-- Contenedor con gradiente que brilla al hacer hover -->
                <div @mouseenter="playHover()" class="group relative rounded-[2rem] p-[2px] overflow-hidden transition-transform duration-500 hover:-translate-y-3 {{ $gift->guest_id ? 'grayscale opacity-60' : '' }}">
                    
                    <!-- Borde Mágico Animado -->
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-600 via-transparent to-[#FF7518] opacity-30 group-hover:opacity-100 transition-opacity duration-500 {{ $gift->guest_id ? 'hidden' : '' }}"></div>
                    
                    <!-- Interior de la Tarjeta -->
                    <div class="relative h-full bg-[#130720] rounded-[2rem] p-8 flex flex-col justify-between stitched-border z-10">
                        
                        <!-- Icono decorativo (Pociones/Bebé) -->
                        <div class="absolute top-6 right-6 w-12 h-12 rounded-full bg-white/5 flex items-center justify-center border border-white/10 group-hover:scale-110 transition-transform">
                            <svg class="w-6 h-6 {{ $gift->guest_id ? 'text-gray-600' : 'text-[#FF7518]' }}" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zm0 16a3 3 0 01-3-3h6a3 3 0 01-3 3z"></path></svg>
                        </div>

                        <div>
                            <h3 class="font-creepster text-3xl mb-3 tracking-wide leading-tight {{ $gift->guest_id ? 'text-gray-500' : 'text-purple-200 group-hover:text-white transition-colors' }}">
                                {{ $gift->name }}
                            </h3>
                            <p class="text-base text-gray-400 mb-8 font-light leading-relaxed">
                                {{ $gift->description }}
                            </p>
                        </div>
                        
                        @if($gift->guest_id)
                            <div class="w-full py-4 bg-black/40 text-gray-500 border border-white/5 rounded-xl text-center font-bold tracking-widest uppercase text-sm">
                                Asegurado por un espectro
                            </div>
                        @else
                            <!-- Botón Premium 3D -->
                            <button 
                                @click="playClick(); modalOpen = true; selectedGiftId = {{ $gift->id }}; selectedGiftName = '{{ addslashes($gift->name) }}'"
                                class="relative w-full overflow-hidden rounded-xl py-4 font-bold text-white bg-gradient-to-r from-purple-700 to-[#FF7518] shadow-[0_10px_20px_rgba(255,117,24,0.3)] hover:shadow-[0_15px_30px_rgba(155,89,182,0.5)] transform hover:scale-[1.03] transition-all duration-300">
                                <span class="relative z-10 tracking-widest uppercase text-sm">Elegir para el Bebé</span>
                                <div class="absolute inset-0 bg-white/20 translate-y-full group-hover:translate-y-0 transition-transform duration-300"></div>
                            </button>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    </main>

    <!-- Modal de Confirmación Estilo UI/UX Premium -->
    <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-[#0a0310]/90 backdrop-blur-xl" x-cloak style="display: none;" x-transition:enter="transition ease-out duration-400" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95">
        
        <div @click.away="modalOpen = false" class="bg-gradient-to-b from-[#1a0b29] to-[#0a0310] border border-purple-500/30 rounded-[2.5rem] p-10 max-w-lg w-full shadow-[0_0_80px_rgba(74,14,78,0.6)] relative overflow-hidden">
            
            <div class="absolute top-0 right-0 w-40 h-40 bg-[#FF7518]/20 rounded-full blur-[60px] pointer-events-none"></div>

            <div class="text-center mb-8">
                <h3 class="font-creepster text-5xl text-[#FF7518] mb-3 tracking-widest">Pacto de Cuna</h3>
                <p class="text-gray-300">Has elegido separar el regalo:<br> <strong x-text="selectedGiftName" class="text-white text-xl font-creepster tracking-wider block mt-2"></strong></p>
            </div>
            
            <form action="{{ route('rsvp.confirm') }}" method="POST">
                @csrf
                <input type="hidden" name="gift_id" x-model="selectedGiftId">
                
                <div class="space-y-6 mb-10">
                    <div class="relative">
                        <label class="text-xs font-bold text-purple-300 uppercase tracking-widest ml-4 mb-1 block">Tu Nombre</label>
                        <input type="text" name="name" required class="w-full bg-white/5 border border-white/10 rounded-2xl focus:border-[#FF7518] focus:ring-1 focus:ring-[#FF7518] text-white px-6 py-4 placeholder-gray-500 transition-all shadow-inner" placeholder="Escribe tu nombre aquí...">
                    </div>
                    
                    <div class="relative">
                        <label class="text-xs font-bold text-purple-300 uppercase tracking-widest ml-4 mb-1 block">Número de Contacto</label>
                        <input type="tel" name="phone" required class="w-full bg-white/5 border border-white/10 rounded-2xl focus:border-[#FF7518] focus:ring-1 focus:ring-[#FF7518] text-white px-6 py-4 placeholder-gray-500 transition-all shadow-inner" placeholder="Ej: 300 123 4567">
                        <p class="text-[10px] text-gray-500 ml-4 mt-2 font-light">* Usaremos este número como tu identificador único.</p>
                    </div>
                </div>
                
                <div class="flex flex-col gap-4">
                    <button type="submit" @click="playClick()" class="relative overflow-hidden w-full py-5 bg-gradient-to-r from-[#FF7518] to-orange-600 hover:from-orange-500 hover:to-[#FF7518] text-white font-bold tracking-widest uppercase rounded-2xl shadow-[0_10px_30px_rgba(255,117,24,0.4)] transform hover:-translate-y-1 transition-all duration-300 group">
                        <span class="relative z-10">Confirmar Ofrenda</span>
                        <div class="absolute inset-0 bg-white/20 translate-x-full group-hover:translate-x-0 transition-transform duration-500"></div>
                    </button>
                    <button type="button" @click="modalOpen = false" class="w-full py-3 text-gray-400 hover:text-white font-medium text-sm tracking-widest uppercase transition-colors">
                        Cancelar invocación
                    </button>
                </div>
            </form>
        </div>
    </div>

</body>
</html>