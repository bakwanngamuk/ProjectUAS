<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products in {{ ucfirst($category) }} Category</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .search-input {
            width: 0;
            opacity: 0;
            transition: width 0.3s ease, opacity 0.3s ease;
        }
        .search-input.active {
            width: 200px;
            opacity: 1;
        }
    </style>
    <script>
        function toggleSearch() {
            const searchInput = document.getElementById('search-input');
            searchInput.classList.toggle('active');
            if (searchInput.classList.contains('active')) {
                searchInput.focus();
            }
        }
    </script>
</head>
<body class="bg-white">
    <!-- Navbar -->
    <nav class="bg-black text-white p-4">
        <div class="container mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="text-xl font-bold">PADUKADIA</div>
                {{-- <img src="path-to-logo" alt="Logo" class="h-8"> --}}
            </div>
            <div class="space-x-8">
                <a href="/" class="hover:text-gray-400">Home</a>
                <a href="/my-store" class="hover:text-gray-400">Toko Saya</a>
            </div>
            <div class="space-x-4 flex items-center">
                <div class="relative">
                    <input id="search-input" type="text" placeholder="Search..." class="search-input bg-gray-200 text-black rounded-full px-4 py-1 focus:outline-none">
                    <button onclick="toggleSearch()" class="absolute inset-y-0 right-0 px-3 text-gray-400 hover:text-white focus:outline-none">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-6 w-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z" />
                        </svg>
                    </button>
                </div>
                <a href="/profile" class="hover:text-gray-400">Profile</a>
                <a href="{{ route('cart.index') }}" class="hover:text-gray-400">Cart</a>
                <a href="#" class="hover:text-gray-400" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>
    <!-- Content -->
    <div class="container mx-auto my-8">
        <h1 class="text-3xl font-bold mb-4">Products in {{ ucfirst($category) }} Category</h1>

        @if ($products->isEmpty())
            <p class="text-gray-500">No products found in this category.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($products as $product)
                    <a href="/product/{{ $product->id }}" class="block bg-white rounded-lg shadow-lg p-6 hover:bg-gray-100 transition">
                        <h2 class="text-xl font-bold mb-2">{{ $product->name }}</h2>
                        <p class="text-gray-700 mb-4">{{ $product->description }}</p>
                        <p class="text-gray-900 font-semibold">Price: ${{ $product->price }}</p>
                        <p class="text-gray-600">Quantity: {{ $product->quantity }}</p>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</body>
</html>
