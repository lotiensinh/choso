<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class BuyerReviewController extends Controller
{
    /**
     * Lưu đánh giá sản phẩm (chỉ cho phép người đã mua hàng)
     * Route: POST /review/{product}
     */
    public function store(Request $request, Product $product)
    {
        // Kiểm tra user đã mua sản phẩm chưa (và đã hoàn tất đơn hàng)
        $hasPurchased = Order::where('user_id', Auth::id())
            ->where('product_id', $product->id)
            ->where('status', 'completed')
            ->exists();

        if (!$hasPurchased) {
            return back()->with('error', 'Bạn phải mua sản phẩm này mới có thể đánh giá.');
        }

        // Kiểm tra đã từng đánh giá chưa
        if (Review::where('user_id', Auth::id())->where('product_id', $product->id)->exists()) {
            return back()->with('error', 'Bạn đã đánh giá sản phẩm này rồi.');
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string|max:1000',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'product_id' => $product->id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', '✅ Cảm ơn bạn đã đánh giá!');
    }
}
