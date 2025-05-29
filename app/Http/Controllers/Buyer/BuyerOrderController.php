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
        $orders = Order::where('user_id', Auth::id())->latest()->get();
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
            $product = Product::find($item['id']);
            if (!$product) continue;

            Order::create([
                'product_id' => $product->id,
                'user_id' => Auth::id(),
                'email' => $request->email,
                'screenshot_path' => $path,
                'is_paid' => false,
            ]);
        }

        session()->forget('cart');

        return redirect('/')->with('success', 'Đơn hàng đã được gửi. Chờ xác nhận thanh toán!');
    }

    // ✅ Gắn sản phẩm vào session (API/add AJAX)
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
        unset($item); // tránh bug PHP

        if (!$found) {
            $cart[] = ['id' => $request->product_id, 'qty' => 1];
        }

        session(['cart' => $cart]);

        return response()->json([
            'message' => $found ? '🛒 Đã tăng số lượng trong giỏ!' : '✅ Đã thêm vào giỏ hàng!',
            'cart_count' => collect($cart)->sum('qty'),
        ]);
    }

    // ============ CHUẨN HÓA GIỎ HÀNG TRUYỀN THỐNG ============

    // Hiển thị giỏ hàng
    public function cartView()
    {
        // Convert lại về format dùng chung, lấy đầy đủ info sản phẩm
        $cartRaw = session()->get('cart', []);
        $cart = [];
        foreach ($cartRaw as $item) {
            // Nếu item chỉ có id & qty thì lấy thêm từ DB, còn nếu đã có name/price/thumbnail thì giữ nguyên
            $product = Product::find($item['id']);
            if ($product) {
                $cart[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'price' => $product->price,
                    'thumbnail' => $product->thumbnail_path,
                    'quantity' => $item['qty'] ?? $item['quantity'] ?? 1,
                ];
            }
        }
        $total = collect($cart)->sum(fn($i) => $i['price'] * $i['quantity']);

        return view('buyer.cart.index', compact('cart', 'total'));

        $categories = \App\Models\Category::orderBy('priority', 'desc')->get();
        $suggested = \App\Models\Product::orderBy('sold', 'desc')->limit(4)->get();
        return view('buyer.cart.index', compact('cart', 'total', 'categories', 'suggested'));

    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function cartRemove(Request $request)
    {
        $cart = session()->get('cart', []);
        $id = $request->input('id');
        // Lọc ra khỏi cart
        $cart = array_filter($cart, function ($item) use ($id) {
            return $item['id'] != $id;
        });
        session()->put('cart', array_values($cart)); // reindex lại key
        // Thông báo toast thành công
        return redirect()->route('cart.index')->with('success', 'Đã xoá sản phẩm khỏi giỏ hàng!');
    }
}
