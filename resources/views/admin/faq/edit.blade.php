@extends('layouts.admin')

@section('title', 'Edit FAQ')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <a href="{{ route('admin.faq.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">← Back</a>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Edit FAQ</h1>
        
        <form method="POST" action="{{ route('admin.faq.updateItem', $faq->id) }}">
            @csrf @method('PUT')
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Category</label>
                <select name="faq_category_id" required class="w-full border rounded px-3 py-2">
                    <option value="">Select Category</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ $faq->faq_category_id == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Question</label>
                <input type="text" name="question" value="{{ $faq->question }}" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Answer</label>
                <textarea name="answer" rows="6" required class="w-full border rounded px-3 py-2">{{ $faq->answer }}</textarea>
            </div>
            
            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Update</button>
                <a href="{{ route('admin.faq.items') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
