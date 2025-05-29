<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;

class BuyerCategoryController extends Controller
{
    /**
     * Hiển thị sản phẩm theo danh mục với SEO & Breadcrumbs (chuẩn hóa cho Livewire filter)
     *
     * @param string $slug
     * @return \Illuminate\View\View
     */
    public function show($slug)
    {
        $category = Category::where('slug', $slug)->firstOrFail();

        // SEO
        $pageTitle = $category->name . ' | Choso.io';
        $pageDescription = 'Khám phá các sản phẩm số thuộc danh mục ' . $category->name . ' trên nền tảng Choso.io. Tải xuống dễ dàng, an toàn, nhanh chóng.';

        // Tất cả danh mục (header)
        $categories = Category::all();

        // Sản phẩm nổi bật
        $featuredProducts = Product::where('is_featured', true)
            ->where('is_approved', true)
            ->latest()
            ->take(8)
            ->get();

        /**
         * Không truyền $products trực tiếp vào view nữa
         * (để filter bằng Livewire component)
         * -> Nhúng filter component và truyền categoryId, các biến khác vẫn truyền bình thường.
         */

        return view('buyer.categories.show', compact(
            'category',
            'categories',
            'featuredProducts',
            'pageTitle',
            'pageDescription'
        ));
    }
}
