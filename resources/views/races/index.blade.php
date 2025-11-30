<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Carreras') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                            {{ session('error') }}
                        </div>
                    @endif

                    @can('create', App\Models\Race::class)
                        <div class="mb-4">
                            <a href="{{ route('races.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                + Nueva Carrera
                            </a>
                        </div>
                    @endcan

                    @if($races->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nombre</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Circuito</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Juego</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Participantes</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($races as $race)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('races.show', $race) }}" class="text-blue-600 hover:underline font-medium">
                                                    {{ $race->name }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $race->circuit }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $race->game }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $race->race_date->format('d/m/Y H:i') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="px-2 py-1 text-xs rounded-full 
                                                    @if($race->status === 'upcoming') bg-blue-100 text-blue-800
                                                    @elseif($race->status === 'ongoing') bg-yellow-100 text-yellow-800
                                                    @elseif($race->status === 'completed') bg-green-100 text-green-800
                                                    @else bg-red-100 text-red-800
                                                    @endif">
                                                    {{ ucfirst($race->status) }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $race->users_count }}/{{ $race->max_participants }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm">
                                                <div class="flex space-x-2">
                                                    <a href="{{ route('races.show', $race) }}" class="text-blue-600 hover:underline">Ver</a>
                                                    
                                                    @can('update', $race)
                                                        <a href="{{ route('races.edit', $race) }}" class="text-green-600 hover:underline">Editar</a>
                                                    @endcan
                                                    
                                                    @can('delete', $race)
                                                        <form action="{{ route('races.destroy', $race) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta carrera?')">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-red-600 hover:underline">Eliminar</button>
                                                        </form>
                                                    @endcan
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        
                        <div class="mt-4">
                            {{ $races->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No hay carreras registradas.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>