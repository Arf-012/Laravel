<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') Inventory Management</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-50 min-h-screen flex">
    <header class="flex min-h-screen">
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <a href="{{ route('products.index') }}" class="text-xl font-bold text-primary flex">
                    Inventory Management
                </a>
            </div>


            <nav class="mt-6">
                <div class="px-4 space-y-2">
                    @auth
                    <div class="px-4 mt-4">
                        <form action="{{ route('products.index') }}" method="GET" class="relative">
                            <x-lucide-search
                                class="absolute left-3 top-1/2 transform -translate-y-1/2 w-4 h-4 text-gray-400" />
                            <input type="text" name="search" placeholder="Cari produk..."
                                value="{{ request('search') }}"
                                class="pl-10 pr-3 py-2 border rounded-full border-gray-300 text-sm w-50 focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                        </form>
                    </div>
                    <a href="{{ route('products.index') }}" class="nav-item">
                        <i class="fas fa-chart-line mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('products.list') }}" class="nav-item">
                        <i class="fas fa-box mr-3"></i>
                        Products
                    </a>
                    <div class="mt-auto">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" class="nav-item w-full text-left flex items-center px-3 py-2 rounded-lg hover:bg-red-50 text-red-600 font-medium">
                                <i class="fas fa-sign-out-alt mr-3"></i>
                                Logout
                            </button>
                        </form>
                    </div>
                    @endauth
                    @guest
                        <a href="{{ route('show.register') }}" class="nav-item">
                            <i class="fas fa-user-plus mr-3"></i>
                            Register
                        </a>
                        <a href="{{ route('show.login') }}" class="nav-item">
                            <i class="fas fa-sign-in-alt mr-3"></i>
                            Login
                        </a>
                    @endguest
                </div>
            </nav>
        </div>
    </header>
    <main class="container mx-auto flex-grow p-4">
        @if (session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>

</html>
