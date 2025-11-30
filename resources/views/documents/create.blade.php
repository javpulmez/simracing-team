<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Subir Documento') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Nombre -->
                        <div class="mb-4">
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Nombre del Documento *</label>
                            <input type="text" name="name" id="name" value="{{ old('name') }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Archivo -->
                        <div class="mb-4">
                            <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Archivo *</label>
                            <input type="file" name="file" id="file" required accept=".pdf,.doc,.docx,.xls,.xlsx,.zip" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <p class="text-xs text-gray-500 mt-1">Formatos permitidos: PDF, DOC, DOCX, XLS, XLSX, ZIP (máx. 10MB)</p>
                            @error('file')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tipo de Archivo -->
                        <div class="mb-4">
                            <label for="file_type" class="block text-sm font-medium text-gray-700 mb-2">Tipo de Documento *</label>
                            <select name="file_type" id="file_type" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Seleccionar tipo</option>
                                <option value="setup" {{ old('file_type') == 'setup' ? 'selected' : '' }}>Setup</option>
                                <option value="reglamento" {{ old('file_type') == 'reglamento' ? 'selected' : '' }}>Reglamento</option>
                                <option value="guia" {{ old('file_type') == 'guia' ? 'selected' : '' }}>Guía</option>
                                <option value="resultado" {{ old('file_type') == 'resultado' ? 'selected' : '' }}>Resultado</option>
                                <option value="otro" {{ old('file_type') == 'otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                            @error('file_type')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Carrera Relacionada -->
                        <div class="mb-4">
                            <label for="race_id" class="block text-sm font-medium text-gray-700 mb-2">Carrera Relacionada (Opcional)</label>
                            <select name="race_id" id="race_id" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                                <option value="">Ninguna</option>
                                @foreach($races as $race)
                                    <option value="{{ $race->id }}" {{ old('race_id') == $race->id ? 'selected' : '' }}>
                                        {{ $race->name }} - {{ $race->race_date->format('d/m/Y') }}
                                    </option>
                                @endforeach
                            </select>
                            @error('race_id')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('documents.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Subir Documento
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>