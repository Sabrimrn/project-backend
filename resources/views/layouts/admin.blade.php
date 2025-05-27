<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin') - {{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen">
        <nav class="bg-gray-800 text-white p-4">
            <div class="container mx-auto flex justify-between items-center">
                <h1 class="text-xl font-bold">Admin Panel</h1>
                <div class="flex gap-4">
                    <a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
                    <a href="{{ route('admin.news.index') }}" class="hover:underline">News</a>
                    <a href="{{ route('admin.faq.index') }}" class="hover:underline">FAQ</a>
                    <a href="{{ route('admin.contact.index') }}" class="hover:underline">Contact</a>
                    <a href="{{ route('dashboard') }}" class="hover:underline">← Back to Site</a>
                </div>
            </div>
        </nav>
        
        <main class="py-8">
            @yield('content')
        </main>
    </div>
</body>
</html>