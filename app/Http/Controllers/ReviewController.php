<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $productId)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:255',
        ]);

        $review = new Review();
        $review->product_id = $productId;
        $review->user_id = Auth::id();
        $review->rating = $request->input('rating');
        $review->review = $request->input('review');
        $review->status = 'pending'; // Atau 'approved' sesuai kebutuhan
        $review->save();

        return redirect()->back()->with('success', 'Review submitted successfully.');
    }
}