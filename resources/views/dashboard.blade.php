@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-6">
                    Dashboard
                </h2>
                
                <div class="bg-green-50 border border-green-200 rounded-lg p-4 mb-6">
                    <p class="text-green-800">Welcome back! You're successfully logged in.</p>
                </div>
                
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <div class="bg-blue-50 p-6 rounded-lg">
                        <h3 class="font-semibold text-blue-800 mb-3">Browse Content</h3>
                        <div class="space-y-2">
                            <a href="{{ route('news.index') }}" class="block text-blue-600 hover:text-blue-800 hover:underline">
                                📰 Latest News
                            </a>
                            <a href="{{ route('faq.index') }}" class="block text-blue-600 hover:text-blue-800 hover:underline">
                                ❓ FAQ Section
                            </a>
                        </div>
                    </div>
                    
                    <div class="bg-purple-50 p-6 rounded-lg">
                        <h3 class="font-semibold text-purple-800 mb-3">Your Profile</h3>
                        <div class="space-y-2">
                            <a href="{{ route('profile.edit') }}" class="block text-purple-600 hover:text-purple-800 hover:underline">
                                ⚙️ Edit Profile
                            </a>
                            <a href="{{ route('profile.show', auth()->user()) }}" class="block text-purple-600 hover:text-purple-800 hover:underline">
                                👤 View Profile
                            </a>
                        </div>
                    </div>
                    
                    <div class="bg-green-50 p-6 rounded-lg">
                        <h3 class="font-semibold text-green-800 mb-3">Get Help</h3>
                        <div class="space-y-2">
                            <a href="{{ route('contact.create') }}" class="block text-green-600 hover:text-green-800 hover:underline">
                                📧 Contact Support
                            </a>
                            <a href="{{ route('faq.index') }}" class="block text-green-600 hover:text-green-800 hover:underline">
                                💡 Browse FAQ
                            </a>
                        </div>
                    </div>
                </div>
                
                @if(auth()->user()->is_admin ?? false)
                <div class="mt-8 bg-red-50 border border-red-200 rounded-lg p-6">
                    <h3 class="font-semibold text-red-800 mb-3">🔧 Admin Panel</h3>
                    <a href="{{ route('admin.dashboard') }}" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 transition-colors">
                        Go to Admin Dashboard
                    </a>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection