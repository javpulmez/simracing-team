<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nuestros Pilotos') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    @if(auth()->check() && auth()->user()->isAdmin())
                        <div class="mb-4">
                            <a href="{{ route('drivers.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                + Agregar Piloto
                            </a>
                        </div>
                    @endif

                    @if($drivers->count() > 0)
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                            @foreach($drivers as $driver)
                                <div class="border rounded-lg p-6 text-center hover:shadow-lg transition">
                                    <div class="w-32 h-32 mx-auto mb-4 bg-gray-200 rounded-full flex items-center justify-center overflow-hidden">
                                        @if($driver->photo)
                                            <img src="{{ Storage::url($driver->photo) }}" alt="{{ $driver->nickname }}" class="w-full h-full object-cover">
                                        @else
                                            <span class="text-4xl font-bold text-gray-400">{{ substr($driver->nickname, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    
                                    <h3 class="font-bold text-xl mb-1">{{ $driver->nickname }}</h3>
                                    
                                    @if($driver->racing_number)
                                        <p class="text-sm text-gray-500 mb-2">#{{ $driver->racing_number }}</p>
                                    @endif
                                    
                                    <p class="text-sm text-gray-600 mb-2">{{ $driver->country }}</p>
                                    
                                    @if($driver->bio)
                                        <p class="text-sm text-gray-700 line-clamp-3">{{ $driver->bio }}</p>
                                    @endif
                                    
                                    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->id() === $driver->user_id))
                                        <div class="mt-4 pt-4 border-t flex justify-center space-x-2">
                                            <a href="{{ route('drivers.edit', $driver) }}" class="text-blue-600 hover:underline text-sm">
                                                Editar
                                            </a>
                                            @if(auth()->user()->isAdmin())
                                                <form action="{{ route('drivers.destroy', $driver) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar este piloto?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:underline text-sm">
                                                        Eliminar
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-6">
                            {{ $drivers->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No hay pilotos registrados aún.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>