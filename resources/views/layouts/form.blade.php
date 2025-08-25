<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') - User Dashboard</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-800 min-h-screen flex">

    {{-- Sidebar --}}
    <aside class="w-64 bg-white shadow-lg flex flex-col">
        <div class="p-6 border-b border-gray-200">
            <h2 class="text-2xl font-bold text-indigo-600">User Dashboard</h2>
            <p class="text-sm text-gray-500 mt-1">Welcome, {{ Auth::user()->name }}</p>
        </div>

        {{-- Search Bar --}}
        <div class="p-4 border-gray-200 pt-6">
            <form action="{{ route('user.dashboard') }}" method="GET" class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 transform -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" placeholder="Cari produk..."
                    value="{{ request('search') }}"
                    class="pl-10 pr-3 py-2 w-full border rounded-full border-gray-300 text-sm focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </form>
        </div>

        {{-- Navigation --}}
        <nav class="mt-2 flex-1 px-4 space-y-2">
            <a href="{{ route('user.dashboard') }}"
                class="flex items-center px-3 py-2 rounded-lg hover:bg-indigo-50 text-gray-700 font-medium">
                <i class="fas fa-box mr-3"></i> My Products
            </a>
            <a href="{{ route('user.products.create') }}"
                class="flex items-center px-3 py-2 rounded-lg hover:bg-indigo-50 text-gray-700 font-medium">
                <i class="fas fa-plus-circle mr-3"></i> Add Product
            </a>

            {{-- Logout --}}
            <div class="mt-auto">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="flex items-center w-full text-left px-3 py-2 rounded-lg hover:bg-red-50 text-red-600 font-medium">
                        <i class="fas fa-sign-out-alt mr-3"></i> Logout
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    {{-- Main Content --}}
    <main class="flex-1 p-6">
        {{-- Alert Success --}}
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded shadow">
                {{ session('success') }}
            </div>
        @endif

        {{-- Page Content --}}
        <div class="bg-white shadow rounded-lg p-6 mx-auto max-w-4xl">
            @yield('content')
        </div>
    </main>

</body>
</html>
