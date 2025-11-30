<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar Perfil de Piloto') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <form action="{{ route('drivers.update', $driver) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nickname -->
                        <div class="mb-4">
                            <label for="nickname" class="block text-sm font-medium text-gray-700 mb-2">Nickname *</label>
                            <input type="text" name="nickname" id="nickname" value="{{ old('nickname', $driver->nickname) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('nickname')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- País -->
                        <div class="mb-4">
                            <label for="country" class="block text-sm font-medium text-gray-700 mb-2">País *</label>
                            <input type="text" name="country" id="country" value="{{ old('country', $driver->country) }}" required class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('country')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Número de Carrera -->
                        <div class="mb-4">
                            <label for="racing_number" class="block text-sm font-medium text-gray-700 mb-2">Número de Carrera</label>
                            <input type="text" name="racing_number" id="racing_number" value="{{ old('racing_number', $driver->racing_number) }}" maxlength="3" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('racing_number')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Foto Actual -->
                        @if($driver->photo)
                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-700 mb-2">Foto Actual</label>
                                <img src="{{ Storage::url($driver->photo) }}" alt="{{ $driver->nickname }}" class="w-32 h-32 object-cover rounded-full">
                            </div>
                        @endif

                        <!-- Nueva Foto -->
                        <div class="mb-4">
                            <label for="photo" class="block text-sm font-medium text-gray-700 mb-2">Nueva Foto</label>
                            <input type="file" name="photo" id="photo" accept="image/*" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            @error('photo')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Bio -->
                        <div class="mb-4">
                            <label for="bio" class="block text-sm font-medium text-gray-700 mb-2">Biografía</label>
                            <textarea name="bio" id="bio" rows="4" class="w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500">{{ old('bio', $driver->bio) }}</textarea>
                            @error('bio')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Botones -->
                        <div class="flex justify-end space-x-2">
                            <a href="{{ route('drivers.public') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                                Cancelar
                            </a>
                            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                Actualizar Piloto
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>