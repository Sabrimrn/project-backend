@extends('layouts.app')

@section('title', 'FAQ')

@section('content')
<div class="container mx-auto px-4 py-8">
    <h1 class="text-3xl font-bold text-gray-800 mb-8">Frequently Asked Questions</h1>
    
    @forelse($categories as $category)
    <div class="mb-8">
        <h2 class="text-2xl font-semibold text-gray-800 mb-4">{{ $category->name }}</h2>
        <div class="space-y-4">
            @foreach($category->faqItems as $item)
            <div class="bg-white rounded-lg shadow-md">
                <div class="p-6">
                    <h3 class="text-lg font-medium text-gray-800 mb-2">{{ $item->question }}</h3>
                    <p class="text-gray-700">{{ $item->answer }}</p>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @empty
    <div class="text-center py-8">
        <p class="text-gray-500">No FAQ items available yet.</p>
    </div>
    @endforelse
</div>
@endsection