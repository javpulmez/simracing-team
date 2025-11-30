<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Carrera') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('races.update', $race) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Nombre -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre de la Carrera *</label>
                            <input type="text" name="name" id="name" value="{{ old('name', $race->name) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Descripción -->
                        <div class="mb-4">
                            <label for="description" class="block text-sm font-medium text-gray-700 mb-2">Descripción</label>
                            <textarea name="description" id="description" rows="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('description', $race->description) }}</textarea>
                            @error('description')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Circuito -->
                        <div class="mb-4">
                            <label for="circuit" class="block text-sm font-medium text-gray-700 mb-2">Circuito *</label>
                            <input type="text" name="circuit" id="circuit" value="{{ old('circuit', $race->circuit) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('circuit')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Juego -->
                        <div class="mb-4">
                            <label for="game" class="block text-sm font-medium text-gray-700 mb-2">Juego/Simulador *</label>
                            <select name="game" id="game" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Seleccionar juego</option>
                                <option value="iRacing" {{ old('game', $race->game) == 'iRacing' ? 'selected' : '' }}>iRacing</option>
                                <option value="Assetto Corsa Competizione" {{ old('game', $race->game) == 'Assetto Corsa Competizione' ? 'selected' : '' }}>Assetto Corsa Competizione</option>
                                <option value="F1 2024" {{ old('game', $race->game) == 'F1 2024' ? 'selected' : '' }}>F1 2024</option>
                                <option value="rFactor 2" {{ old('game', $race->game) == 'rFactor 2' ? 'selected' : '' }}>rFactor 2</option>
                                <option value="Gran Turismo 7" {{ old('game', $race->game) == 'Gran Turismo 7' ? 'selected' : '' }}>Gran Turismo 7</option>
                                <option value="Forza Motorsport" {{ old('game', $race->game) == 'Forza Motorsport' ? 'selected' : '' }}>Forza Motorsport</option>
                            </select>
                            @error('game')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fecha y Hora -->
                        <div class="mb-4">
                            <label for="race_date" class="block text-sm font-medium text-gray-700 mb-2">Fecha y Hora *</label>
                            <input type="datetime-local" name="race_date" id="race_date" value="{{ old('race_date', $race->race_date->format('Y-m-d\TH:i')) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('race_date')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Máximo de Participantes -->
                        <div class="mb-4">
                            <label for="max_participants" class="block text-sm font-medium text-gray-700 mb-2">Máximo de Participantes *</label>
                            <input type="number" name="max_participants" id="max_participants" value="{{ old('max_participants', $race->max_participants) }}" min="2" max="50" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('max_participants')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Estado -->
                        <div class="mb-4">
                            <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Estado *</label>
                            <select name="status" id="status" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="upcoming" {{ old('status', $race->status) == 'upcoming' ? 'selected' : '' }}>Próxima</option>
                                <option value="ongoing" {{ old('status', $race->status) == 'ongoing' ? 'selected' : '' }}>En Curso</option>
                                <option value="completed" {{ old('status', $race->status) == 'completed' ? 'selected' : '' }}>Completada</option>
                                <option value="cancelled" {{ old('status', $race->status) == 'cancelled' ? 'selected' : '' }}>Cancelada</option>
                            </select>
                            @error('status')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('races.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Actualizar Carrera
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>