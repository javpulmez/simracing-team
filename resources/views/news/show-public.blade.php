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
                    @if($news->image)
                        <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" class="w-full h-96 object-cover rounded-lg mb-6">
                    @endif

                    <h1 class="text-4xl font-bold mb-4">{{ $news->title }}</h1>
                    
                    <div class="text-sm text-gray-500 mb-6 flex items-center space-x-2">
                        <span>Por {{ $news->user->name }}</span>
                        <span>•</span>
                        <span>{{ $news->created_at->format('d/m/Y H:i') }}</span>
                    </div>

                    <div class="prose max-w-none text-gray-700 leading-relaxed">
                        {!! nl2br(e($news->content)) !!}
                    </div>

                    <div class="mt-8 pt-6 border-t">
                        <a href="{{ route('news.public') }}" class="text-blue-600 hover:underline">
                            ← Volver a noticias
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>