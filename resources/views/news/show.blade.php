@extends('layouts.app')

@section('title', $news->title)

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <article class="bg-white rounded-lg shadow-md overflow-hidden">
        @if($news->image)
            <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" class="w-full h-64 object-cover">
        @endif
        <div class="p-8">
            <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $news->title }}</h1>
            <p class="text-gray-600 mb-6">Published on {{ \Carbon\Carbon::parse($news->created_at)->format('d-m-Y') }}</p>
            <div class="prose max-w-none">
                {!! nl2br(e($news->content)) !!}
            </div>
        </div>
    </article>
    
    <div class="mt-8">
        <a href="{{ route('news.index') }}" class="inline-flex items-center text-blue-600 hover:underline">
            ← Back to news
        </a>
    </div>
</div>
@endsection