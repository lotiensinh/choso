<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\View;

class BuyerCategoryController extends Controller
{
    /**
     * Hiển thị sản phẩm theo danh mục với SEO & Breadcrumbs
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // SEO: tiêu đề, mô tả
        $pageTitle = $category->name . ' | Choso.io';
        $pageDescription = 'Khám phá các sản phẩm số thuộc danh mục ' . $category->name . ' trên nền tảng Choso.io. Tải xuống dễ dàng, an toàn, nhanh chóng.';

        // Sản phẩm
        $products = Product::where('category_id', $category->id)
            ->where('is_approved', true)
            ->with(['user', 'reviews'])
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->latest()
            ->paginate(20);

        // Tất cả danh mục
        $categories = Category::all();

        // Gợi ý nổi bật
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_approved', true)
            ->latest()
            ->take(8)
            ->paginate(20);

        return view('buyer.categories.show', compact(
            'category',
            'products',
            'categories',
            'featuredProducts',
            'pageTitle',
            'pageDescription'
        ));
    }
}
