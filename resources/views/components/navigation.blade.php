<nav class="bg-gray-800 text-white shadow-lg">
    <div class="container mx-auto px-4">
        <div class="flex justify-between items-center py-4">
            <div class="flex items-center space-x-8">
                <a href="{{ route('dashboard') }}" class="text-xl font-bold">Gaming Hub</a>
                <div class="hidden md:flex space-x-6">
                    <a href="{{ route('news.index') }}" class="hover:text-gray-300 transition-colors">News</a>
                    <a href="{{ route('faq.index') }}" class="hover:text-gray-300 transition-colors">FAQ</a>
                    <a href="{{ route('contact') }}" class="hover:text-gray-300 transition-colors">Contact</a>
                </div>
            </div>
            
            <div class="flex items-center space-x-4">
                @auth
                    <div class="relative group">
                        <button class="flex items-center space-x-2 hover:text-gray-300">
                            <span>{{ Auth::user()->username ?? Auth::user()->name }}</span>
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </button>
                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-50 hidden group-hover:block">
                            <a href="{{ route('profile.show', Auth::user()) }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">View Profile</a>
                            <a href="{{ route('profile.edit') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Edit Profile</a>
                            @if(Auth::user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Admin Panel</a>
                            @endif
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="block w-full text-left px-4 py-2 text-sm text-gray-700 hover:bg-gray-100">Logout</button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="hover:text-gray-300 transition-colors">Login</a>
                    <a href="{{ route('register') }}" class="bg-blue-600 px-4 py-2 rounded-md hover:bg-blue-700 transition-colors">Register</a>
                @endauth
            </div>
        </div>
    </div>
</nav>
