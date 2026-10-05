@props(['gifts'])

<!-- SECCIÓN DE REGALOS -->
<main id="regalos" class="max-w-7xl mx-auto px-6 md:px-12 py-24 relative z-10">
    
    <div class="mb-12 animate-fade-in">
        <!-- Título principal con la tipografía temática -->
        <h2 class="font-nightmare text-4xl sm:text-5xl text-[#FF7518] mb-3 tracking-wide">El trineo de regalos</h2>
        <!-- Texto con mejor contraste y tono más cálido -->
        <p class="text-gray-300 text-base md:text-lg font-light">Selecciona un obsequio de la lista para acompañarnos en esta dulce espera.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($gifts as $index => $gift)
            <x-landing.gift-card :gift="$gift" :index="$index" />
        @endforeach
    </div>
</main>