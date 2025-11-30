<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard Administrador') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-6">Estadísticas del Sistema</h3>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-blue-100 rounded-lg p-6">
                            <div class="text-3xl font-bold text-blue-600 mb-2">{{ $totalRaces }}</div>
                            <div class="text-gray-700">Total de Carreras</div>
                        </div>
                        
                        <div class="bg-green-100 rounded-lg p-6">
                            <div class="text-3xl font-bold text-green-600 mb-2">{{ $upcomingRaces }}</div>
                            <div class="text-gray-700">Carreras Próximas</div>
                        </div>
                        
                        <div class="bg-purple-100 rounded-lg p-6">
                            <div class="text-3xl font-bold text-purple-600 mb-2">{{ $completedRaces }}</div>
                            <div class="text-gray-700">Carreras Completadas</div>
                        </div>
                    </div>

                    <div class="border-t pt-6">
                        <h4 class="text-xl font-bold mb-4">Acciones Rápidas</h4>
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <a href="{{ route('races.create') }}" class="bg-blue-600 text-white px-4 py-3 rounded-lg text-center hover:bg-blue-700 transition">
                                + Nueva Carrera
                            </a>
                            <a href="{{ route('news.create') }}" class="bg-green-600 text-white px-4 py-3 rounded-lg text-center hover:bg-green-700 transition">
                                + Nueva Noticia
                            </a>
                            <a href="{{ route('drivers.create') }}" class="bg-purple-600 text-white px-4 py-3 rounded-lg text-center hover:bg-purple-700 transition">
                                + Nuevo Piloto
                            </a>
                            <a href="{{ route('documents.create') }}" class="bg-yellow-600 text-white px-4 py-3 rounded-lg text-center hover:bg-yellow-700 transition">
                                + Subir Documento
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>