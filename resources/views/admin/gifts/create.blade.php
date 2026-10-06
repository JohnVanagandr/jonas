<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Materializar un Nuevo Regalo') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <form action="{{ route('admin.gifts.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700">Nombre del Regalo</label>
                            <input type="text" name="name" id="name" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            @error('name') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700">Descripción (Opcional)</label>
                            <textarea name="description" id="description" rows="3" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500"></textarea>
                            @error('description') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- NUEVO: Campo para la URL -->
                        <div class="mb-4">
                            <label for="url" class="block text-sm font-medium text-gray-700">Enlace de Referencia (Opcional)</label>
                            <input type="url" name="url" id="url" placeholder="https://ejemplo.com/producto" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            @error('url') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <!-- NUEVO: Campo para el Stock -->
                        <div class="mb-6">
                            <label for="stock" class="block text-sm font-medium text-gray-700">Cupos Disponibles (Stock)</label>
                            <input type="number" name="stock" id="stock" value="1" min="1" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-purple-500 focus:ring-purple-500">
                            <p class="text-xs text-gray-500 mt-1">Cantidad de personas diferentes que pueden elegir este mismo regalo.</p>
                            @error('stock') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
                        </div>

                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.gifts.index') }}" class="px-4 py-2 text-gray-600 hover:text-gray-900 font-bold transition">Cancelar</a>
                            <button type="submit" class="px-6 py-2 bg-purple-600 hover:bg-purple-700 text-white font-bold rounded shadow transition">Guardar Regalo</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>