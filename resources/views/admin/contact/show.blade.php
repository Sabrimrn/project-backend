@extends('layouts.admin')

@section('title', 'Contact Message')

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <a href="{{ route('admin.contact.index') }}" class="text-blue-600 hover:underline mb-4 inline-block">← Back</a>
    
    <div class="bg-white rounded-lg shadow p-6">
        <h1 class="text-2xl font-bold mb-4">{{ $contact->subject }}</h1>
        
        <div class="mb-4">
            <p><strong>From:</strong> {{ $contact->name }} ({{ $contact->email }})</p>
            <p><strong>Date:</strong> {{ $contact->created_at->format('F j, Y \a\t g:i A') }}</p>
        </div>
        
        <div class="bg-gray-50 p-4 rounded">
            <h3 class="font-semibold mb-2">Message:</h3>
            <p class="whitespace-pre-line">{{ $contact->message }}</p>
        </div>
        
        <div class="mt-6">
            <a href="mailto:{{ $contact->email }}?subject=Re: {{ $contact->subject }}" 
               class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 mr-3">Reply</a>
            
            <form method="POST" action="{{ route('admin.contact.destroy', $contact->id) }}" class="inline">
                @csrf @method('DELETE')
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700" 
                        onclick="return confirm('Delete this message?')">Delete</button>
            </form>
        </div>
    </div>
</div>
@endsection