<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;

class BuyerHomeController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with(['user', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->where('is_featured', true)
            ->where('is_approved', true)
            ->latest()
            ->paginate(6);

        $categories = Category::orderBy('name')->get();

        return view('buyer.home', compact('featuredProducts', 'categories'));
    }
}
