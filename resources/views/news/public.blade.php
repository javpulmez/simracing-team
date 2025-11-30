<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Noticias') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($news->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($news as $item)
                        <div class="bg-white rounded-lg shadow-sm overflow-hidden hover:shadow-lg transition">
                            @if($item->image)
                                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
                            @else
                                <div class="w-full h-48 bg-gray-200 flex items-center justify-center">
                                    <span class="text-gray-400 text-4xl">📰</span>
                                </div>
                            @endif
                            
                            <div class="p-6">
                                <h3 class="text-xl font-bold mb-2">
                                    <a href="{{ route('news.show.public', $item) }}" class="hover:text-blue-600">
                                        {{ $item->title }}
                                    </a>
                                </h3>
                                <p class="text-gray-600 mb-4">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                                <div class="text-xs text-gray-500">
                                    Por {{ $item->user->name }} • {{ $item->created_at->diffForHumans() }}
                                </div>
                                <a href="{{ route('news.show.public', $item) }}" class="inline-block mt-4 text-blue-600 hover:underline">
                                    Leer más →
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
                
                <div class="mt-6">
                    {{ $news->links() }}
                </div>
            @else
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-center text-gray-500">
                        No hay noticias publicadas en este momento.
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>