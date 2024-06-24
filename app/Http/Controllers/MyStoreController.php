<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product; // Pastikan model Product sudah ada

class MyStoreController extends Controller
{
    // Menampilkan halaman "Toko Saya"
    public function index()
    {
        $products = Product::where('id_toko', auth()->id())->get();
        return view('my-store.index', compact('products'));
    }

    // Mengunggah produk baru
    public function upload(Request $request)
    {
        // dd($request);
        $request->validate([
            'name' => 'required|string|max:255',
            'category' => 'required|string',
            'description' => 'required|string',
            'price' => 'required|integer',
            'quantity' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            ]);
            
        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);

        // dd($request);
        
        Product::create([
            'id_toko' => auth()->id(),
            'name' => $request->name,
            'category' => $request->category,
            'description' => $request->description,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'image_url' => '/images/' . $imageName,
        ]);

        return redirect()->route('my-store.index')->with('success', 'Product uploaded successfully!');
    }
}