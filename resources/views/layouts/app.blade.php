<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title') Toko Online</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-50 min-h-screen flex">
    <header class="flex h-screen">
        <div class="w-64 bg-white shadow-lg">
            <div class="p-6 border-b border-gray-200">
                <a href="{{ route('products.index') }}" class="text-xl font-bold text-primary flex justify-center text-gray-800">
                    Toko Online
                </a>
            </div>


            <nav class="mt-6">
                <div class="px-4 space-y-2">
                    <a href="{{ route('products.index') }}" class="flex items-center px-4 py-3 text-gray-700 rounded-l-lg">
                        <i class="fas fa-chart-line mr-3"></i>
                        Dashboard
                    </a>
                    <a href="{{ route('products.create') }}" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-box mr-3"></i>
                        Products
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-shopping-cart mr-3"></i>
                        Orders
                    </a>
                    <a href="#" class="flex items-center px-4 py-3 text-gray-600 hover:bg-gray-50 rounded-lg transition-colors">
                        <i class="fas fa-users mr-3"></i>
                        Customers
                    </a>
                </div>
            </nav>
        </div>
    </header>
    <main class="container mx-auto flex-grow p-4">
        @if(session('success'))
            <div class="mb-4 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                {{ session('success') }}
            </div>
        @endif

        @yield('content')
    </main>
</body>
</html>
