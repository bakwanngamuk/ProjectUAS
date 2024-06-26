<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
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
<body class="bg-gray-100">
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
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-2xl font-bold mb-4">Shopping Cart</h1>

        @if(session('success'))
            <div class="bg-green-100 text-green-700 p-4 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        <div class="bg-white shadow-md rounded-lg p-6 mb-6">
            <div class="flex justify-between border-b pb-4 mb-4">
                <div class="font-bold text-gray-700">Product</div>
                <div class="font-bold text-gray-700">Quantity</div>
                <div class="font-bold text-gray-700">Price</div>
                <div class="font-bold text-gray-700">Total</div>
                <div class="font-bold text-gray-700">Actions</div>
            </div>

            @foreach($cart as $id => $item)
                <div class="flex justify-between items-center border-b pb-4 mb-4">
                    <div class="w-2/5 flex items-center">
                        <img src="https://via.placeholder.com/80" alt="Product Image" class="w-16 h-16 rounded mr-4">
                        <div>
                            <div class="font-bold text-gray-700">{{ $item['name'] }}</div>
                        </div>
                    </div>
                    <div class="w-1/5 text-center">
                        <input type="number" value="{{ $item['quantity'] }}" class="w-16 text-center border border-gray-300 rounded" readonly>
                    </div>
                    <div class="w-1/5 text-center">${{ number_format($item['price'], 2) }}</div>
                    <div class="w-1/5 text-center">${{ number_format($item['total'], 2) }}</div>
                    <div class="w-1/5 text-center">
                        <a href="{{ route('cart.remove', $id) }}" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Remove</a>
                    </div>
                </div>
            @endforeach

            @php
                $total = array_reduce($cart, function ($sum, $item) {
                    return $sum + $item['total'];
                }, 0);
            @endphp

            <div class="flex justify-end items-center">
                <div class="text-xl font-bold">Total: ${{ number_format($total, 2) }}</div>
            </div>
        </div>

        <div class="flex justify-end">
            <button class="bg-blue-500 text-white px-6 py-3 rounded hover:bg-blue-600">Proceed to Checkout</button>
        </div>
    </div>
</body>
</html>