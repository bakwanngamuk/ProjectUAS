<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Success</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
        <div class="bg-white rounded-lg shadow-lg p-6 text-center">
            <h1 class="text-3xl font-bold mb-4">Payment Successful!</h1>
            <p class="text-gray-700 mb-4">Thank you for your purchase. Your payment has been successfully processed.</p>
            <a href="/" class="bg-black text-white py-2 px-4 rounded hover:bg-gray-800">Back to Home</a>
        </div>
    </div>
</body>
</html>