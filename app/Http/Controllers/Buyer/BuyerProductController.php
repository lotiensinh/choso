<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class BuyerProductController extends Controller
{
    public function index(Request $request, $slug = null)
    {
        $categories = Category::all();

        $featuredProducts = Product::with(['user', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->where('is_featured', true)
            ->where('is_approved', true)
            ->latest()
            ->take(6)
            ->get();

        $query = Product::with(['user', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->where('is_approved', true);

        $category = null;

        if ($slug && $slug !== 'tat-ca-san-pham') {
    $category = Category::where('slug', $slug)->firstOrFail();
    $query->where('category_id', $category->id);
        } elseif ($request->filled('slug')) {
            $category = Category::where('slug', $request->slug)->firstOrFail();
            $query->where('category_id', $category->id);
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('min_price') && $request->filled('max_price')) {
            $min = (int) $request->min_price;
            $max = (int) $request->max_price;
            if ($min <= $max) {
                $query->whereBetween('price', [$min, $max]);
            }
        }

        
        return view('buyer.home', compact('products', 'categories', 'featuredProducts', 'category'));
    }

    public function show($slug)
    {
        $product = Product::with(['user', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->where('slug', $slug)
            ->where('is_approved', true)
            ->firstOrFail();

        return view('buyer.products.detail', compact('product'));
    }

    public function ajaxFilter(Request $request)
    {
        $query = Product::with(['user', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->where('is_approved', true);

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if ($request->filled('category_slug') && $request->category_slug !== 'tat-ca-san-pham') {
            $category = Category::where('slug', $request->category_slug)->first();
            if ($category) {
                $query->where('category_id', $category->id);
            }
        }

        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }

        if ($request->filled('min_price') && $request->filled('max_price')) {
            $min = (int) $request->min_price;
            $max = (int) $request->max_price;
            if ($min <= $max) {
                $query->whereBetween('price', [$min, $max]);
            }
        }

                $categories = Category::all();

        return view('components.product-section', compact('products', 'categories'))->render();
    }
}
