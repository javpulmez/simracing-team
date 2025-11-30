<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h3 class="text-2xl font-bold mb-4">Bienvenido, {{ auth()->user()->name }}</h3>
                    <p class="mb-4">Actualmente tienes una cuenta de visitante. Para acceder a más funciones, contacta con el administrador para cambiar tu rol.</p>
                    
                    <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6">
                        <h4 class="font-bold mb-2">¿Quieres ser piloto?</h4>
                        <p class="text-sm text-gray-700">Como piloto podrás:</p>
                        <ul class="list-disc list-inside text-sm text-gray-700 mt-2">
                            <li>Inscribirte en carreras</li>
                            <li>Ver y descargar documentos del equipo</li>
                            <li>Registrar tus resultados</li>
                            <li>Acceder a setups y material exclusivo</li>
                        </ul>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <a href="{{ route('home') }}" class="block p-4 border rounded-lg hover:shadow-lg transition">
                            <h4 class="font-bold mb-2">Ver Inicio</h4>
                            <p class="text-sm text-gray-600">Explora la página principal del equipo</p>
                        </a>
                        
                        <a href="{{ route('drivers.public') }}" class="block p-4 border rounded-lg hover:shadow-lg transition">
                            <h4 class="font-bold mb-2">Conocer Pilotos</h4>
                            <p class="text-sm text-gray-600">Ve quiénes forman parte del equipo</p>
                        </a>
                        
                        <a href="{{ route('news.public') }}" class="block p-4 border rounded-lg hover:shadow-lg transition">
                            <h4 class="font-bold mb-2">Leer Noticias</h4>
                            <p class="text-sm text-gray-600">Mantente al día con las últimas noticias</p>
                        </a>
                        
                        <a href="{{ route('profile.edit') }}" class="block p-4 border rounded-lg hover:shadow-lg transition">
                            <h4 class="font-bold mb-2">Editar Perfil</h4>
                            <p class="text-sm text-gray-600">Actualiza tu información personal</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>