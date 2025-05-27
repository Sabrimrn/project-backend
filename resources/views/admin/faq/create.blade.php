@extends('layouts.admin')

@section('title', 'Create FAQ')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <a href="{{ route('admin.faq.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">← Back</a>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-6">Create New FAQ</h1>
        
        <form method="POST" action="{{ route('admin.faq.store') }}">
            @csrf
            
            <div class="grid grid-cols-2 gap-4 mb-4">
                <div>
                    <label class="block text-sm font-medium mb-2">Category</label>
                    <select name="category" required class="w-full border rounded px-3 py-2">
                        <option value="">Select Category</option>
                        <option value="account">Account</option>
                        <option value="gameplay">Gameplay</option>
                        <option value="technical">Technical</option>
                        <option value="community">Community</option>
                    </select>
                </div>
                
                <div>
                    <label class="block text-sm font-medium mb-2">Status</label>
                    <select name="status" required class="w-full border rounded px-3 py-2">
                        <option value="draft">Draft</option>
                        <option value="published">Published</option>
                    </select>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="block text-sm font-medium mb-2">Question</label>
                <input type="text" name="question" required class="w-full border rounded px-3 py-2">
            </div>
            
            <div class="mb-6">
                <label class="block text-sm font-medium mb-2">Answer</label>
                <textarea name="answer" rows="6" required class="w-full border rounded px-3 py-2"></textarea>
            </div>
            
            <div class="flex gap-4">
                <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700">Create</button>
                <a href="{{ route('admin.faq.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection
