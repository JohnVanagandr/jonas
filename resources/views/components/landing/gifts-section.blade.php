@props(['gifts'])

<!-- SECCIÓN DE REGALOS -->
<main id="regalos" class="max-w-7xl mx-auto px-6 md:px-12 py-24 relative z-10">
    
    <div class="mb-12 animate-fade-in">
        <h2 class="text-4xl font-bold text-white mb-2">El trineo de regalos</h2>
        <p class="text-gray-400 text-lg">Selecciona un elemento para confirmar tu asistencia.</p>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
        @foreach($gifts as $index => $gift)
            <x-landing.gift-card :gift="$gift" :index="$index" />
        @endforeach
    </div>
</main>