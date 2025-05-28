<?php

namespace App\Http\Controllers\Buyer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Support\Facades\Storage;

class BuyerOrderController extends Controller
{
    public function index()
    {
        $orders = \App\Models\Order::where('user_id', \Auth::id())->latest()->get();
        return view('buyer.orders', compact('orders'));
    }

    public function checkout($slug)
    {
        $product = Product::where('slug', $slug)
            ->with('user')
            ->withAvg('reviews', 'rating')
            ->withCount('reviews')
            ->firstOrFail();

        return view('buyer.checkout.product', compact('product'));
    }

    public function process(Request $request, $slug)
    {
        $request->validate([
            'email' => 'required|email',
            'screenshot' => 'required|image|max:2048',
        ]);

        $product = Product::where('slug', $slug)->firstOrFail();

        $path = $request->file('screenshot')->store('payments', 'public');

        Order::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'email' => $request->email,
            'screenshot_path' => $path,
            'is_paid' => false,
        ]);

        return redirect('/')->with('success', 'Đơn hàng đã được gửi thành công!');
    }

    // 🛒 Thanh toán giỏ hàng
    public function checkoutCart()
    {
        $cart = session('cart', []);
        if (empty($cart)) {
            return redirect('/gio-hang')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        return view('buyer.checkout.cart', compact('cart'));
    }

    public function processCart(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'screenshot' => 'required|image|max:2048',
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng trống.');
        }

        $path = $request->file('screenshot')->store('payments', 'public');

        foreach ($cart as $item) {
            // Kiểm tra sản phẩm có tồn tại không
            $product = \App\Models\Product::find($item['id']);

            if (!$product) {
                continue; // bỏ qua nếu sản phẩm không tồn tại
            }

            \App\Models\Order::create([
                'product_id' => $product->id,
                'user_id' => \Illuminate\Support\Facades\Auth::id(),
                'email' => $request->email,
                'screenshot_path' => $path,
                'is_paid' => false,
            ]);
        }

        session()->forget('cart');

        return redirect('/')->with('success', 'Đơn hàng đã được gửi. Chờ xác nhận thanh toán!');
    }

    // ✅ Cập nhật: gắn sản phẩm và tăng số lượng vào session
    public function cartAdd(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $cart = session()->get('cart', []);
        $found = false;

        foreach ($cart as &$item) {
            if ($item['id'] == $request->product_id) {
                $item['qty'] = ($item['qty'] ?? 1) + 1;
                $found = true;
                break;
            }
        }

        if (!$found) {
            $cart[] = ['id' => $request->product_id, 'qty' => 1];
        }

        session(['cart' => $cart]);

        return response()->json([
            'message' => $found ? '🛒 Đã tăng số lượng trong giỏ!' : '✅ Đã thêm vào giỏ hàng!',
            'cart_count' => collect($cart)->sum('qty'),
        ]);
    }
}
