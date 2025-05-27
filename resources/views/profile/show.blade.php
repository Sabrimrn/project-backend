@extends('layouts.app')

@section('title', $user->username ?? $user->name)

@section('content')
<div class="container mx-auto px-4 py-8 max-w-4xl">
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="bg-gradient-to-r from-blue-500 to-purple-600 h-32"></div>
        <div class="relative px-8 pb-8">
            <div class="flex flex-col sm:flex-row items-start sm:items-end -mt-16 mb-6">
                <div class="relative">
                    @if($user->profile_photo)
                        <img src="{{ Storage::url($user->profile_photo) }}" alt="{{ $user->username ?? $user->name }}" 
                             class="w-32 h-32 rounded-full border-4 border-white object-cover">
                    @else
                        <div class="w-32 h-32 rounded-full border-4 border-white bg-gray-300 flex items-center justify-center">
                            <span class="text-3xl text-gray-600">{{ substr($user->name, 0, 1) }}</span>
                        </div>
                    @endif
                </div>
                <div class="mt-4 sm:mt-0 sm:ml-6 flex-1">
                    <h1 class="text-3xl font-bold text-gray-800">{{ $user->username ?? $user->name }}</h1>
                    @if($user->birthday)
                        <p class="text-gray-600">Born {{ $user->birthday->format('F j, Y') }}</p>
                    @endif
                    @auth
                        @if(auth()->id() === $user->id)
                            <a href="{{ route('profile.edit') }}" class="inline-block mt-2 bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                                Edit Profile
                            </a>
                        @endif
                    @endauth
                </div>
            </div>
            
            @if($user->about_me)
                <div class="mb-6">
                    <h2 class="text-xl font-semibold text-gray-800 mb-3">About Me</h2>
                    <p class="text-gray-700">{{ $user->about_me }}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection