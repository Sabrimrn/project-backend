@extends('layouts.admin')

@section('title', 'Edit FAQ')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <a href="{{ route('admin.faq.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">← Back</a>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Edit FAQ</h1>
        
        <form method="POST" action="{{ route('admin.faq.update', $faq->id) }}">
            @csrf @method('PUT')
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Category</label>
                    <select name="category" required class="w-full border rounded px-3 py-2">
                        <option value="">Select Category</option>
                        <option value="account" {{ $faq->category == 'account' ? 'selected' : '' }}>Account</option>
                        <option value="gameplay" {{ $faq->category == 'gameplay' ? 'selected' : '' }}>Gameplay</option>
                        <option value="technical" {{ $faq->category == 'technical' ? 'selected' : '' }}>Technical</option>
                        <option value="community" {{ $faq->category == 'community' ? 'selected' : '' }}>Community</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Status</label>
                    <select name="status" required class="w-full border rounded px-3 py-2">
                        <option value="draft" {{ $faq->status == 'draft' ? 'selected' : '' }}>Draft</option>
                        <option value="published" {{ $faq->status == 'published' ? 'selected' : '' }}>Published</option>
                    </select>
                </div>
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
                <a href="{{ route('admin.faq.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection