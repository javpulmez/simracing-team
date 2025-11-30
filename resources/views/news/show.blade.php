<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $news->title }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            @if($news->published)
                                <span class="px-3 py-1 text-sm rounded-full bg-green-100 text-green-800">Publicado</span>
                            @else
                                <span class="px-3 py-1 text-sm rounded-full bg-yellow-100 text-yellow-800">Borrador</span>
                            @endif
                        </div>
                        
                        @can('update', $news)
                            <div class="flex space-x-2">
                                <a href="{{ route('news.edit', $news) }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                    Editar
                                </a>
                                @can('delete', $news)
                                    <form action="{{ route('news.destroy', $news) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar esta noticia?')">
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

                    @if($news->image)
                        <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" class="w-full h-96 object-cover rounded-lg mb-6">
                    @endif

                    <h1 class="text-4xl font-bold mb-4">{{ $news->title }}</h1>
                    
                    <div class="text-sm text-gray-500 mb-6">
                        Por {{ $news->user->name }} • {{ $news->created_at->format('d/m/Y H:i') }}
                    </div>

                    <div class="prose max-w-none">
                        {!! nl2br(e($news->content)) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>