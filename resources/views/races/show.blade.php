<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $race->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
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

            <!-- Información Principal -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <h1 class="text-3xl font-bold mb-2">{{ $race->name }}</h1>
                            <span class="px-3 py-1 text-sm rounded-full 
                                @if($race->status === 'upcoming') bg-blue-100 text-blue-800
                                @elseif($race->status === 'ongoing') bg-yellow-100 text-yellow-800
                                @elseif($race->status === 'completed') bg-green-100 text-green-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($race->status) }}
                            </span>
                        </div>
                        
                        @can('update', $race)
                            <div class="flex space-x-2">
                                <a href="{{ route('races.edit', $race) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                    Editar
                                </a>
                                @can('delete', $race)
                                    <form action="{{ route('races.destroy', $race) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta carrera?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                            Eliminar
                                        </button>
                                    </form>
                                @endcan
                            </div>
                        @endcan
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div>
                            <h3 class="font-bold text-lg mb-2">Detalles</h3>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-sm text-gray-600">Circuito</dt>
                                    <dd class="text-lg font-semibold">{{ $race->circuit }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm text-gray-600">Simulador</dt>
                                    <dd class="text-lg font-semibold">{{ $race->game }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm text-gray-600">Fecha y Hora</dt>
                                    <dd class="text-lg font-semibold">{{ $race->race_date->format('d/m/Y H:i') }}</dd>
                                </div>
                            </dl>
                        </div>

                        <div>
                            <h3 class="font-bold text-lg mb-2">Participación</h3>
                            <dl class="space-y-2">
                                <div>
                                    <dt class="text-sm text-gray-600">Participantes Inscritos</dt>
                                    <dd class="text-lg font-semibold">{{ $race->users->count() }} / {{ $race->max_participants }}</dd>
                                </div>
                                <div>
                                    <dt class="text-sm text-gray-600">Plazas Disponibles</dt>
                                    <dd class="text-lg font-semibold">{{ $race->max_participants - $race->users->count() }}</dd>
                                </div>
                            </dl>

                            @auth
                                @if(auth()->user()->isPilot())
                                    @if($race->status === 'upcoming')
                                        @if($isRegistered)
                                            <form action="{{ route('races.unregister', $race) }}" method="POST" class="mt-4">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                                                    Cancelar Inscripción
                                                </button>
                                            </form>
                                        @else
                                            @if($race->users->count() < $race->max_participants)
                                                <form action="{{ route('races.register', $race) }}" method="POST" class="mt-4">
                                                    @csrf
                                                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                                        Inscribirme
                                                    </button>
                                                </form>
                                            @else
                                                <div class="mt-4 bg-gray-100 text-gray-600 px-4 py-2 rounded text-center">
                                                    Carrera llena
                                                </div>
                                            @endif
                                        @endif
                                    @endif
                                @endif
                            @endauth
                        </div>
                    </div>

                    @if($race->description)
                        <div class="border-t pt-4">
                            <h3 class="font-bold text-lg mb-2">Descripción</h3>
                            <p class="text-gray-700">{{ $race->description }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Participantes Inscritos -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-4">Participantes Inscritos</h3>
                    
                    @if($race->users->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-4 lg:grid-cols-6 gap-4">
                            @foreach($race->users as $user)
                                <div class="text-center">
                                    <div class="w-20 h-20 mx-auto mb-2 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
                                        @if($user->driver && $user->driver->photo)
                                            <img src="{{ Storage::url($user->driver->photo) }}" alt="{{ $user->name }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-2xl font-bold text-gray-400">{{ substr($user->name, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <p class="font-semibold text-sm">
                                        @if($user->driver)
                                            {{ $user->driver->nickname }}
                                        @else
                                            {{ $user->name }}
                                        @endif
                                    </p>
                                    <p class="text-xs text-gray-500">
                                        @if($user->pivot->status === 'confirmed')
                                            <span class="text-green-600">✓ Confirmado</span>
                                        @else
                                            <span class="text-yellow-600">Registrado</span>
                                        @endif
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Aún no hay participantes inscritos.</p>
                    @endif
                </div>
            </div>

            <!-- Resultados (si está completada) -->
            @if($race->status === 'completed' && $race->results->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-4">Resultados</h3>
                        
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Pos</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Piloto</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Puntos</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Vuelta Rápida</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($race->results->sortBy('position') as $result)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <span class="font-bold text-lg">{{ $result->position }}</span>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                @if($result->user->driver)
                                                    {{ $result->user->driver->nickname }}
                                                @else
                                                    {{ $result->user->name }}
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $result->points }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $result->fastest_lap ?? '-' }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Documentos Relacionados -->
            @if($race->documents->count() > 0)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-4">Documentos</h3>
                        
                        <div class="space-y-2">
                            @foreach($race->documents as $document)
                                <div class="flex justify-between items-center p-3 border rounded hover:bg-gray-50">
                                    <div>
                                        <p class="font-semibold">{{ $document->name }}</p>
                                        <p class="text-xs text-gray-500">{{ ucfirst($document->file_type) }} • Subido por {{ $document->user->name }}</p>
                                    </div>
                                    <a href="{{ route('documents.show', $document) }}" class="bg-blue-600 text-white px-3 py-1 rounded text-sm hover:bg-blue-700">
                                        Descargar
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>