<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Piloto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Mis Carreras -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-4">Mis Carreras Inscritas</h3>
                    
                    @if($myRaces->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Carrera</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Circuito</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Fecha</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Estado</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Participantes</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @foreach($myRaces as $race)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">
                                                <a href="{{ route('races.show', $race) }}" class="text-blue-600 hover:underline font-medium">
                                                    {{ $race->name }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $race->circuit }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $race->race_date->format('d/m/Y H:i') }}</td>
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
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $race->users->count() }}/{{ $race->max_participants }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-gray-500">No estás inscrito en ninguna carrera aún.</p>
                        <a href="{{ route('races.index') }}" class="inline-block mt-4 bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Ver Carreras Disponibles
                        </a>
                    @endif
                </div>
            </div>

            <!-- Mis Resultados -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h3 class="text-2xl font-bold mb-4">Mis Últimos Resultados</h3>
                    
                    @if($myResults->count() > 0)
                        <div class="space-y-4">
                            @foreach($myResults as $result)
                                <div class="border rounded-lg p-4">
                                    <div class="flex justify-between items-center">
                                        <div>
                                            <h4 class="font-bold text-lg">{{ $result->race->name }}</h4>
                                            <p class="text-sm text-gray-600">{{ $result->race->circuit }}</p>
                                        </div>
                                        <div class="text-right">
                                            <div class="text-3xl font-bold text-blue-600">P{{ $result->position }}</div>
                                            <div class="text-sm text-gray-500">{{ $result->points }} pts</div>
                                        </div>
                                    </div>
                                    @if($result->fastest_lap)
                                        <p class="text-xs text-gray-500 mt-2">Vuelta rápida: {{ $result->fastest_lap }}</p>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">Aún no tienes resultados registrados.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>