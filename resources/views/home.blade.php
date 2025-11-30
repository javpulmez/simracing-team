<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Bienvenido al Equipo SimRacing') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Hero Section -->
            <div class="bg-gradient-to-r from-blue-600 to-blue-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 text-white">
                    <h1 class="text-4xl font-bold mb-4">Team SimRacing</h1>
                    <p class="text-xl mb-4">Competencia, pasión y velocidad virtual</p>
                    @guest
                        <a href="{{ route('register') }}" class="inline-block bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100 transition">
                            Únete al Equipo
                        </a>
                    @endguest
                </div>
            </div>

            <!-- Próximas Carreras -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">Próximas Carreras</h2>
                    
                    @if($upcomingRaces->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($upcomingRaces as $race)
                                <div class="border rounded-lg p-4 hover:shadow-lg transition">
                                    <h3 class="font-bold text-lg mb-2">{{ $race->name }}</h3>
                                    <p class="text-gray-600 mb-2">{{ $race->circuit }}</p>
                                    <p class="text-sm text-gray-500 mb-2">{{ $race->game }}</p>
                                    <p class="text-sm font-semibold">{{ $race->race_date->format('d/m/Y H:i') }}</p>
                                    <p class="text-xs text-gray-500 mt-2">
                                        Participantes: {{ $race->users_count ?? 0 }}/{{ $race->max_participants }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500">No hay carreras programadas próximamente.</p>
                    @endif
                </div>
            </div>

            <!-- Pilotos Destacados -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">Nuestros Pilotos</h2>
                    
                    @if($drivers->count() > 0)
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-4">
                            @foreach($drivers as $driver)
                                <div class="text-center">
                                    <div class="w-24 h-24 mx-auto mb-2 bg-gray-200 rounded-full flex items-center justify-center">
                                        @if($driver->photo)
                                            <img src="{{ Storage::url($driver->photo) }}" alt="{{ $driver->nickname }}" class="w-full h-full rounded-full object-cover">
                                        @else
                                            <span class="text-3xl font-bold text-gray-400">{{ substr($driver->nickname, 0, 1) }}</span>
                                        @endif
                                    </div>
                                    <p class="font-semibold">{{ $driver->nickname }}</p>
                                    <p class="text-xs text-gray-500">{{ $driver->country }}</p>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('drivers.public') }}" class="text-blue-600 hover:underline">Ver todos los pilotos →</a>
                        </div>
                    @else
                        <p class="text-gray-500">Aún no hay pilotos registrados.</p>
                    @endif
                </div>
            </div>

            <!-- Últimas Noticias -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <h2 class="text-2xl font-bold mb-4">Últimas Noticias</h2>
                    
                    @if($latestNews->count() > 0)
                        <div class="space-y-4">
                            @foreach($latestNews as $news)
                                <div class="border-b pb-4">
                                    <h3 class="font-bold text-lg mb-2">
                                        <a href="{{ route('news.show.public', $news) }}" class="hover:text-blue-600">
                                            {{ $news->title }}
                                        </a>
                                    </h3>
                                    <p class="text-gray-600 mb-2">{{ Str::limit(strip_tags($news->content), 150) }}</p>
                                    <p class="text-xs text-gray-500">
                                        Por {{ $news->user->name }} • {{ $news->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            @endforeach
                        </div>
                        <div class="mt-4 text-center">
                            <a href="{{ route('news.public') }}" class="text-blue-600 hover:underline">Ver todas las noticias →</a>
                        </div>
                    @else
                        <p class="text-gray-500">No hay noticias disponibles.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>