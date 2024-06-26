<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toko Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.2.1/dist/cdn.min.js" defer></script>
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
                <a href="#" class="hover:text-gray-400" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                <form id="logout-form" action="/logout" method="POST" style="display: none;">
                    @csrf
                </form>
            </div>
        </div>
    </nav>

    <!-- Toko Saya Section -->
    <div class="container mx-auto mt-10 p-5">
        <h2 class="text-2xl font-bold mb-5">Toko Saya</h2>
        <div class="bg-white p-5 rounded shadow-md">
            <!-- Form to Upload Product -->
            <form action="{{ route('my-store.upload') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-700 mb-2">Product Name</label>
                    <input type="text" name="name" id="name" class="w-full px-3 py-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="description" class="block text-gray-700 mb-2">Description</label>
                    <textarea name="description" id="description" class="w-full px-3 py-2 border border-gray-300 rounded" required></textarea>
                </div>
                <div class="mb-4">
                    <label for="price" class="block text-gray-700 mb-2">Price</label>
                    <input type="number" name="price" id="price" class="w-full px-3 py-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <label for="quantity" class="block text-gray-700 mb-2">Quantity</label>
                    <input type="number" name="quantity" id="quantity" class="w-full px-3 py-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4" x-data="{ open: false, query: '', categories: ['Shoes', 'Cosmetic', 'Electronic', 'Toys'], filteredCategories: [] }" x-init="filteredCategories = categories">
                    <label for="category" class="block text-gray-700 mb-2">Category</label>
                    <div class="relative">
                        <input type="text" id="category" name="category" @click="open = !open" @input="open = true; filteredCategories = categories.filter(category => category.toLowerCase().includes(query.toLowerCase()))" x-model="query" placeholder="Search for category..." class="w-full px-3 py-2 border border-gray-300 rounded mb-2">
                        <div x-show="open" class="absolute z-10 bg-white w-full border border-gray-300 rounded shadow-md max-h-48 overflow-y-auto">
                            <template x-for="category in filteredCategories" :key="category">
                                <div @click="query = category; open = false;" class="px-4 py-2 cursor-pointer hover:bg-gray-100" x-text="category"></div>
                            </template>
                            <div x-show="filteredCategories.length === 0" class="px-4 py-2 text-gray-500">No results found.</div>
                        </div>
                    </div>
                </div>
                <div class="mb-4">
                    <label for="image" class="block text-gray-700 mb-2">Product Image</label>
                    <input type="file" name="image" id="image" class="w-full px-3 py-2 border border-gray-300 rounded" required>
                </div>
                <div class="mb-4">
                    <button type="submit" class="w-full bg-black text-white py-2 rounded hover:bg-gray-800">Upload Product</button>
                </div>
            </form>
        </div>

        <!-- Display Uploaded Products -->
        <div class="mt-10">
            <h3 class="text-xl font-bold mb-5">My Products</h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($products as $product)
                    <div class="bg-white p-5 rounded shadow-md">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-48 object-cover mb-4 rounded">
                        <h4 class="text-lg font-bold">{{ $product->name }}</h4>
                        <p class="text-gray-700">{{ $product->description }}</p>
                        <p class="text-gray-900 font-semibold">Price: ${{ $product->price }}</p>
                        <p class="text-gray-600">Quantity: {{ $product->quantity }}</p>
                        <a href="{{ url('product', $product->id) }}" class="block mt-2 bg-black text-white text-center py-2 rounded hover:bg-blue-600">View Product</a>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</body>
</html>