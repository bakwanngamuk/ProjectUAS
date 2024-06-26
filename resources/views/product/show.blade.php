<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
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
        <div class="bg-white rounded-lg shadow-lg p-6">
            <h1 class="text-3xl font-bold mb-4">{{ $product->name }}</h1>
            <p class="text-gray-700 mb-4">{{ $product->description }}</p>
            <p class="text-gray-900 font-semibold">Price: ${{ $product->price }}</p>
            <p class="text-gray-600 mb-4">Quantity: {{ $product->quantity }}</p>

            <!-- Rating and Reviews -->
            <h2 class="text-2xl font-bold mt-6">Ratings & Reviews</h2>
            <div class="mt-4">
                @if($product->reviews && $product->reviews->count() > 0)
                    @foreach ($product->reviews as $review)
                        @if ($review->status == 'approved')
                            <div class="border-t mt-4 pt-4">
                                <div class="flex items-center mb-2">
                                    <div class="text-yellow-500">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            ★
                                        @endfor
                                        @for ($i = $review->rating; $i < 5; $i++)
                                            ☆
                                        @endfor
                                    </div>
                                    <div class="ml-4 text-gray-600">{{ $review->user->name }}</div>
                                </div>
                                <p class="text-gray-700">{{ $review->review }}</p>
                            </div>
                        @endif
                    @endforeach
                @else
                    <p class="text-gray-700">No reviews yet.</p>
                @endif
            </div>

            <!-- Write a Review -->
            <h2 class="text-2xl font-bold mt-6">Write a Review</h2>
            <form action="{{ route('reviews.store', $product->id) }}" method="POST" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="rating" class="block text-gray-700 mb-2">Rating</label>
                    <select name="rating" id="rating" class="w-full px-3 py-2 border border-gray-300 rounded" required>
                        <option value="1">1 - Very Poor</option>
                        <option value="2">2 - Poor</option>
                        <option value="3">3 - Average</option>
                        <option value="4">4 - Good</option>
                        <option value="5">5 - Excellent</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="review" class="block text-gray-700 mb-2">Review</label>
                    <textarea name="review" id="review" rows="4" class="w-full px-3 py-2 border border-gray-300 rounded" required></textarea>
                </div>
                <button type="submit" class="bg-black text-white py-2 px-4 rounded hover:bg-green-600">Submit Review</button>
            </form>

            <!-- Buy and Add to Cart Buttons -->
            <div class="flex space-x-4 mt-6">
                <a href="{{ route('checkout', $product->id) }}" class="bg-black text-white py-2 px-4 rounded hover:bg-green-600">Buy Now</a>
                <a href="{{ route('cart.add', $product->id) }}" class="bg-black text-white py-2 px-4 rounded hover:bg-blue-600">Add to Cart</a>
            </div>
        </div>
    </div>
</body>
</html>
