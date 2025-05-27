@extends('layouts.app')

@section('title', 'Gaming News')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Latest Gaming News</h1>
    
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($news as $item)
        <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition-shadow">
            @if($item->image)
                <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover">
            @endif
            <div class="p-6">
                <h2 class="text-xl font-semibold mb-2">
                    <a href="{{ route('news.show', $item->id) }}" class="text-gray-800 hover:text-blue-600">
                        {{ $item->title }}
                    </a>
                </h2>
                <p class="text-gray-600 text-sm mb-3">{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</p>
                <p class="text-gray-700">{{ Str::limit(strip_tags($item->content), 120) }}</p>
                <a href="{{ route('news.show', $item->id) }}" class="inline-block mt-3 text-blue-600 hover:underline">
                    Read more →
                </a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-8">
            <p class="text-gray-500">No news available yet.</p>
        </div>
        @endforelse
    </div>
    
    <div class="mt-8">
        {{ $news->links() }}
    </div>
</div>
@endsection

