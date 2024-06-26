<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Tampilkan semua produk dari kategori tertentu
    public function getProductsByCategory($category)
    {
        $products = Product::where('category', $category)->get();
        // dd($products);
        return view('products', compact('products', 'category'));
    }

    public function show($id)
    {
        $product = Product::with('reviews.user')->findOrFail($id);
        return view('product.show', compact('product'));
    }



    // Metode lainnya (CRUD) jika diperlukan
}