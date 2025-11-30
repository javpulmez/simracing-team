<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Gestión de Noticias') }}
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

                    @can('create', App\Models\News::class)
                        <div class="mb-4">
                            <a href="{{ route('news.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                                + Nueva Noticia
                            </a>
                        </div>
                    @endcan

                    @if($news->count() > 0)
                        <div class="space-y-4">
                            @foreach($news as $item)
                                <div class="border rounded-lg p-4 hover:shadow-lg transition">
                                    <div class="flex justify-between items-start">
                                        <div class="flex-1">
                                            <div class="flex items-center space-x-2 mb-2">
                                                <h3 class="text-xl font-bold">{{ $item->title }}</h3>
                                                @if($item->published)
                                                    <span class="px-2 py-1 text-xs rounded-full bg-green-100 text-green-800">Publicado</span>
                                                @else
                                                    <span class="px-2 py-1 text-xs rounded-full bg-yellow-100 text-yellow-800">Borrador</span>
                                                @endif
                                            </div>
                                            <p class="text-gray-600 mb-2">{{ Str::limit(strip_tags($item->content), 200) }}</p>
                                            <p class="text-xs text-gray-500">
                                                Por {{ $item->user->name }} • {{ $item->created_at->format('d/m/Y H:i') }}
                                            </p>
                                        </div>
                                        
                                        @if($item->image)
                                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="w-32 h-32 object-cover rounded ml-4">
                                        @endif
                                    </div>
                                    
                                    <div class="mt-4 pt-4 border-t flex space-x-2">
                                        <a href="{{ route('news.show', $item) }}" class="text-blue-600 hover:underline text-sm">Ver</a>
                                        
                                        @can('update', $item)
                                            <a href="{{ route('news.edit', $item) }}" class="text-green-600 hover:underline text-sm">Editar</a>
                                        @endcan
                                        
                                        @can('delete', $item)
                                            <form action="{{ route('news.destroy', $item) }}" method="POST" class="inline" onsubmit="return confirm('¿Estás seguro de eliminar esta noticia?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:underline text-sm">Eliminar</button>
                                            </form>
                                        @endcan
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                        <div class="mt-4">
                            {{ $news->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 text-center py-8">No hay noticias creadas.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>