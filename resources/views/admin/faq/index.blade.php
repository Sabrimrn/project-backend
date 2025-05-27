@extends('layouts.admin')

@section('title', 'FAQ Management')

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-3xl font-bold">FAQ Management</h1>
        <a href="{{ route('admin.faq.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add FAQ</a>
    </div>
    
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left">Question</th>
                    <th class="px-6 py-3 text-left">Category</th>
                    <th class="px-6 py-3 text-left">Status</th>
                    <th class="px-6 py-3 text-left">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($faqs as $faq)
                <tr class="border-t">
                    <td class="px-6 py-4">{{ Str::limit($faq->question, 50) }}</td>
                    <td class="px-6 py-4">{{ ucfirst($faq->category) }}</td>
                    <td class="px-6 py-4">
                        <span class="px-2 py-1 text-xs rounded {{ $faq->status === 'published' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                            {{ ucfirst($faq->status) }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.faq.edit', $faq->id) }}" class="text-blue-600 hover:underline mr-3">Edit</a>
                        <form method="POST" action="{{ route('admin.faq.destroy', $faq->id) }}" class="inline">
                            @csrf @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline" onclick="return confirm('Delete?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-4 text-center text-gray-500">No FAQs found</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection