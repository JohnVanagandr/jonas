<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{asset('img/icono.png')}}">

    
    <!-- Componente SEO -->
    <x-landing.seo />
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;700&display=swap" rel="stylesheet">
    
    <!-- Vite carga automáticamente el CSS y el JS que acabamos de separar -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        @font-face {
            font-family: 'NightmareFont';
            src: url('{{ asset('fonts/nightmare.ttf') }}') format('truetype');
            font-weight: normal;
            font-style: normal;
            font-display: swap;
        }
    </style>
</head>
<body class="bg-[#0f1115] text-gray-100 font-outfit antialiased selection:bg-[#FF7518] selection:text-white" 
      x-data="nightmareApp()">

    <!-- Audios -->
    <audio x-ref="bgMusic" loop preload="auto"><source src="{{ asset('sounds/Before_Christmas_This_Is_Halloween.mp3') }}" type="audio/mpeg"></audio>
    <audio x-ref="clickSfx" preload="auto"><source src="{{ asset('sounds/mysterious.wav') }}" type="audio/mpeg"></audio>

    <!-- Imagen de fondo -->
    <div class="fixed inset-0 z-[-2] bg-cover bg-center bg-no-repeat transition-transform duration-[20s] ease-linear transform hover:scale-105" 
         style="background-image: url('{{ asset('img/fondo.jpg') }}');">
    </div>
    <div class="fixed inset-0 z-[-1] bg-[#0f1115]/85 backdrop-blur-[2px]"></div>

    <!-- Componentes -->
    <x-landing.navbar />
    <x-landing.hero />
    <x-landing.gifts-section :gifts="$gifts" />
    <x-landing.rsvp-modal />
    <x-landing.scroll-top />

    <!-- Alertas -->
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

</body>
</html>