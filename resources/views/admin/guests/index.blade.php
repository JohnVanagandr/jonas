<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Lista de Espectros Confirmados') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-100 border-b-2 border-gray-200">
                                <th class="p-3 font-bold uppercase text-sm text-gray-600">Nombre</th>
                                <th class="p-3 font-bold uppercase text-sm text-gray-600">Teléfono</th>
                                <th class="p-3 font-bold uppercase text-sm text-gray-600">Regalo Seleccionado</th>
                                <th class="p-3 font-bold uppercase text-sm text-gray-600">Fecha de Confirmación</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($guests as $guest)
                                <tr class="border-b border-gray-200 hover:bg-gray-50">
                                    <td class="p-3">{{ $guest->name }}</td>
                                    <td class="p-3">{{ $guest->phone }}</td>
                                    <td class="p-3 text-purple-600 font-semibold">
                                        {{ $guest->gifts->count() > 0 ? $guest->gifts->pluck('name')->join(', ') : 'Sin regalo' }}
                                    </td>
                                    <td class="p-3 text-sm text-gray-500">{{ $guest->created_at->format('d/m/Y h:i A') }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="p-3 text-center text-gray-500">Aún no hay almas confirmadas.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>

                    <div class="mt-4">
                        {{ $guests->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</x-app-layout>