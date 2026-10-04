<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Baby Shower - Jonas Samuel</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Creepster&family=Outfit:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .font-creepster { font-family: 'Creepster', system-ui; }
        .font-outfit { font-family: 'Outfit', sans-serif; }
        
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        .animate-fade-in { animation: fadeInUp 0.8s cubic-bezier(0.16, 1, 0.3, 1) forwards; }
    </style>
</head>
<body class="bg-[#0f1115] text-gray-100 font-outfit antialiased selection:bg-[#FF7518] selection:text-white" 
      x-data="nightmareApp()" 
      @click.once="startAudio()">

    <!-- Audios -->
    <audio x-ref="bgMusic" loop preload="auto"><source src="{{ asset('sounds/Before_Christmas_This_Is_Halloween.mp3') }}" type="audio/mpeg"></audio>
    <audio x-ref="clickSfx" preload="auto"><source src="{{ asset('sounds/mysterious.wav') }}" type="audio/mpeg"></audio>

    <!-- IMAGEN DE FONDO (Mantiene gradiente oscuro SÓLO como viñeta para legibilidad del texto) -->
    <div class="fixed inset-0 z-[-2] bg-cover bg-center bg-no-repeat transition-transform duration-[20s] ease-linear transform hover:scale-105" 
         style="background-image: url('{{ asset('img/fondo.jpg') }}');">
    </div>
    <div class="fixed inset-0 z-[-1] bg-[#0f1115]/85 backdrop-blur-[2px]"></div>

    <!-- Navegación -->
    <nav class="absolute top-0 w-full p-6 z-50 flex justify-between items-center animate-fade-in border-b border-white/5">
        <div class="text-xl font-bold tracking-widest uppercase text-gray-300">
            Jonas<span class="text-[#FF7518]"> Samuel</span>
        </div>
        <div class="flex gap-4 items-center">
            @auth
                <a href="{{ route('admin.dashboard') }}" class="bg-transparent border border-gray-600 px-5 py-2 rounded-full text-xs font-bold text-gray-300 hover:text-white hover:border-gray-400 hover:bg-white/5 transition-colors uppercase">Panel Admin</a>
            @endauth
        </div>
    </nav>

    <!-- Alertas Flotantes -->
    @if (session('success'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed top-24 left-1/2 -translate-x-1/2 z-50 bg-[#15181f] border border-green-500 text-white px-8 py-4 rounded-full shadow-2xl flex items-center gap-3 animate-fade-in">
            <span class="font-bold text-sm uppercase tracking-widest">{{ session('success') }}</span>
        </div>
    @endif
    @if (session('error'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 5000)" class="fixed top-24 left-1/2 -translate-x-1/2 z-50 bg-[#15181f] border border-red-500 text-white px-8 py-4 rounded-full shadow-2xl flex items-center gap-3 animate-fade-in">
            <span class="font-bold text-sm uppercase tracking-widest">{{ session('error') }}</span>
        </div>
    @endif

    <!-- HERO SECTION -->
    <header class="relative w-full min-h-[90vh] flex flex-col justify-center border-b border-gray-800/50">
        <div class="relative z-10 max-w-7xl mx-auto px-6 md:px-12 w-full pt-20 animate-fade-in" style="animation-delay: 0.1s;">
            
            <!-- Etiqueta con color sólido -->
            <span class="inline-block bg-[#FF7518]/10 border border-[#FF7518]/30 text-[#FF7518] font-bold text-xs px-4 py-1.5 rounded-full uppercase tracking-widest mb-6">
                Un Dulce Terror Está por Nacer
            </span>

            <h1 class="font-creepster text-6xl md:text-8xl lg:text-9xl text-white drop-shadow-xl mb-2 leading-none">
                El Extraño Mundo de<br>
                <span class="text-[#FF7518]">Jonas Samuel</span>
            </h1>

            <div class="flex flex-wrap items-center gap-3 md:gap-4 text-gray-300 font-medium text-sm md:text-base mb-6 mt-6 bg-[#15181f]/80 inline-flex px-6 py-3 rounded-2xl border border-gray-800">
                <span class="text-[#FF7518] font-bold">Domingo, 01 Nov</span>
                <span class="w-1.5 h-1.5 bg-gray-600 rounded-full"></span>
                <span>Sede SENA Girón</span>
                <span class="w-1.5 h-1.5 bg-gray-600 rounded-full"></span>
                <span class="text-[#FF7518] font-bold">Disfraz Opcional</span>
            </div>

            <p class="max-w-2xl text-lg md:text-xl text-gray-400 font-light leading-relaxed mb-10">
                La cuna está preparada. Acompáñanos a celebrar la llegada de nuestro pequeño en una noche llena de misterio y ternura. Selecciona un presente para sellar tu asistencia.
            </p>

            <div class="flex flex-col sm:flex-row gap-4">
                <!-- Botón de acción primario (Sólido puro) -->
                <a href="#regalos" class="bg-white hover:bg-gray-200 text-black font-bold text-sm tracking-widest uppercase px-8 py-4 rounded-full flex items-center justify-center gap-2 transition-colors">
                    Ver Lista de Regalos
                </a>
                
                <!-- Botón secundario (Ghost button elegante) -->
                <button @click.stop="toggleMusic()" class="bg-transparent border border-gray-600 hover:border-gray-400 hover:bg-white/5 text-white font-bold text-sm tracking-widest uppercase px-8 py-4 rounded-full flex items-center justify-center gap-2 transition-colors">
                    <svg x-show="!musicPlaying" class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <svg x-show="musicPlaying" x-cloak class="w-5 h-5 text-[#FF7518]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 9v6m4-6v6m7-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span x-text="musicPlaying ? 'Pausar Banda Sonora' : 'Reproducir Banda Sonora'"></span>
                </button>
            </div>
        </div>
    </header>

    <!-- SECCIÓN DE REGALOS -->
    <main id="regalos" class="max-w-7xl mx-auto px-6 md:px-12 py-24 relative z-10">
        
        <div class="mb-12 animate-fade-in">
            <h2 class="text-4xl font-bold text-white mb-2">Artículos para la Cuna</h2>
            <p class="text-gray-400 text-lg">Selecciona un elemento para confirmar tu asistencia.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
            @foreach($gifts as $index => $gift)
                <!-- Tarjetas limpias, sin sombras que brillen -->
                <div class="opacity-0 animate-fade-in bg-[#15181f]/90 border border-gray-800 rounded-3xl p-8 flex flex-col justify-between transition-colors {{ $gift->guest_id ? 'opacity-50 grayscale' : 'hover:border-[#FF7518]/50 hover:bg-[#1a1d24]' }}"
                     style="animation-delay: {{ min($index * 0.05, 1) }}s;">
                    
                    <div class="mb-8">
                        <h3 class="text-2xl font-bold text-white mb-3 leading-tight">
                            {{ $gift->name }}
                        </h3>
                        <p class="text-gray-400 text-base leading-relaxed font-light">
                            {{ $gift->description }}
                        </p>
                    </div>
                    
                    @if($gift->guest_id)
                        <div class="w-full py-4 bg-[#0f1115] text-gray-500 rounded-2xl text-center font-bold uppercase tracking-wider text-xs border border-gray-800">
                            Asegurado
                        </div>
                    @else
                        <!-- Botón Ghost que se rellena al hover -->
                        <button 
                            @click="playClick(); modalOpen = true; selectedGiftId = {{ $gift->id }}; selectedGiftName = '{{ addslashes($gift->name) }}'"
                            class="w-full py-4 bg-transparent border-2 border-gray-700 hover:border-[#FF7518] hover:bg-[#FF7518] text-white rounded-2xl font-bold uppercase tracking-wider text-xs transition-colors text-center">
                            Elegir Regalo
                        </button>
                    @endif
                </div>
            @endforeach
        </div>
    </main>

    <!-- MODAL DE CONFIRMACIÓN -->
    <div x-show="modalOpen" class="fixed inset-0 z-50 flex items-center justify-center bg-black/80 backdrop-blur-sm" x-cloak style="display: none;"
         x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0 scale-95" 
         x-transition:enter-end="opacity-100 scale-100" 
         x-transition:leave="transition ease-in duration-200" 
         x-transition:leave-start="opacity-100 scale-100" 
         x-transition:leave-end="opacity-0 scale-95">
        
        <div @click.away="modalOpen = false" class="bg-[#15181f] border border-gray-800 rounded-[2rem] p-10 max-w-lg w-full mx-4 shadow-2xl relative overflow-hidden">
            
            <div class="mb-8 relative z-10">
                <h3 class="text-3xl font-bold text-white mb-2">Confirmar Asistencia</h3>
                <p class="text-gray-400 text-base">Has seleccionado: <br><strong x-text="selectedGiftName" class="text-[#FF7518]"></strong></p>
            </div>
            
            <form action="{{ route('rsvp.confirm') }}" method="POST" class="relative z-10">
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
                    <!-- Botón de acción sólido y mate -->
                    <button type="submit" @click="playClick()" class="w-full py-4 bg-[#FF7518] hover:bg-[#e66a15] text-white font-bold tracking-widest uppercase rounded-2xl text-sm transition-colors">
                        Asegurar mi Dulce
                    </button>
                    <button type="button" @click="modalOpen = false" class="w-full py-4 bg-transparent text-gray-500 hover:text-white font-bold tracking-widest uppercase rounded-2xl text-sm transition-colors">
                        Cancelar
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Botón Ascender (Volver Arriba - Minimalista) -->
    <button 
        x-show="showScrollTop" 
        x-cloak style="display: none;"
        @click="scrollToTop(); playClick()"
        x-transition:enter="transition ease-out duration-300"
        x-transition:enter-start="opacity-0 translate-y-12"
        x-transition:enter-end="opacity-100 translate-y-0"
        x-transition:leave="transition ease-in duration-300"
        x-transition:leave-start="opacity-100 translate-y-0"
        x-transition:leave-end="opacity-0 translate-y-12"
        class="fixed bottom-8 right-8 z-[60] w-14 h-14 flex items-center justify-center bg-[#15181f] border border-gray-700 hover:border-[#FF7518] hover:bg-[#FF7518] text-gray-400 hover:text-white rounded-full shadow-lg transition-colors group"
        title="Ascender a la superficie">
        
        <svg class="w-6 h-6 transform group-hover:-translate-y-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 15l7-7 7 7"></path>
        </svg>
    </button>

    <!-- Script de control para Alpine -->
    <script>
        function nightmareApp() {
            return {
                modalOpen: false,
                selectedGiftId: null,
                selectedGiftName: '',
                musicPlaying: false,
                audioInit: false,
                showScrollTop: false, 
                
                init() {
                    window.addEventListener('scroll', () => {
                        this.showScrollTop = window.scrollY > 400;
                    });
                },
                
                startAudio() {
                    if (!this.audioInit) {
                        this.$refs.bgMusic.volume = 0.5; 
                        this.$refs.bgMusic.play().catch(e => console.log("Audio bloqueado por el navegador"));
                        this.musicPlaying = true;
                        this.audioInit = true;
                    }
                },
                
                toggleMusic() {
                    if (this.musicPlaying) {
                        this.$refs.bgMusic.pause();
                    } else {
                        this.$refs.bgMusic.play().catch(e => console.log("Audio bloqueado por el navegador"));
                    }
                    this.musicPlaying = !this.musicPlaying;
                    this.audioInit = true; 
                },
                
                playClick() {
                    this.$refs.clickSfx.currentTime = 0;
                    this.$refs.clickSfx.play().catch(e => {});
                },

                scrollToTop() {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                }
            }
        }
    </script>
</body>
</html>