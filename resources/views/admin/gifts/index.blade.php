<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Bóveda de Regalos') }}
            </h2>
            <a href="{{ route('admin.gifts.create') }}" class="bg-purple-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded shadow">
                + Forjar Nuevo Regalo
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if (session('success'))
                <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 flex flex-col overflow-x-auto">
                    <table class="w-full text-left border-collapse min-w-max">
                        <thead>
                            <tr class="bg-gray-100 border-b-2 border-gray-200">
                                <th class="p-3 font-bold uppercase text-sm text-gray-600">Nombre</th>
                                <th class="p-3 font-bold uppercase text-sm text-gray-600">Descripción</th>
                                <!-- NUEVA COLUMNA: Cupos -->
                                <th class="p-3 font-bold uppercase text-sm text-gray-600 text-center">Cupos</th>
                                <th class="p-3 font-bold uppercase text-sm text-gray-600 text-center">Estado</th>
                                <th class="p-3 font-bold uppercase text-sm text-gray-600 text-right">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($gifts as $gift)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="p-3 font-semibold">
                                        {{ $gift->name }}
                                        <!-- NUEVO: Indicador visual si tiene URL -->
                                        @if($gift->url)
                                            <a href="{{ $gift->url }}" target="_blank" rel="noopener" class="inline-block ml-1 text-blue-500 hover:text-blue-700" title="Ver enlace">🔗</a>
                                        @endif
                                    </td>
                                    <td class="p-3 text-sm text-gray-600">{{ Str::limit($gift->description, 50) }}</td>
                                    
                                    <!-- NUEVO: Progreso de reservas vs stock -->
                                    <td class="p-3 text-center text-sm font-bold text-gray-700">
                                        {{ $gift->guests->count() }} / {{ $gift->stock }}
                                    </td>

                                    <!-- ACTUALIZADO: Lógica de estado basada en is_sold_out -->
                                    <td class="p-3 text-center">
                                        @if($gift->is_sold_out)
                                            <span class="px-2 py-1 bg-red-100 text-red-800 rounded text-xs font-bold">Agotado</span>
                                        @else
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded text-xs font-bold">Disponible</span>
                                        @endif
                                    </td>
                                    <td class="p-3 text-right">
                                        <!-- Botón de Editar -->
                                        <a href="{{ route('admin.gifts.edit', $gift) }}" class="text-blue-600 hover:text-blue-900 font-bold text-sm mr-4">Editar</a>
                                        <!-- Botón de Eliminar -->
                                        <form action="{{ route('admin.gifts.destroy', $gift) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Seguro que deseas desvanecer este regalo?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600 hover:text-red-900 font-bold text-sm">Eliminar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-3 text-center text-gray-500">La bóveda está vacía.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                    
                    <div class="mt-4">
                        {{ $gifts->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>