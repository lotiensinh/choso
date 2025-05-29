<?php

// Buyer Controllers
use App\Http\Controllers\Buyer\BuyerHomeController;
use App\Http\Controllers\Buyer\DashboardController;
use App\Http\Controllers\Buyer\BuyerProductController;
use App\Http\Controllers\Buyer\BuyerOrderController;
use App\Http\Controllers\Buyer\BuyerNotificationController;
use App\Http\Controllers\Buyer\SettingController;
use App\Http\Controllers\Buyer\BuyerCategoryController;
use App\Http\Controllers\Buyer\BuyerReviewController;
use App\Http\Controllers\Buyer\BuyerProfileController;

use Illuminate\Support\Facades\Route;

// =======================
// 🔐 Buyer Routes tối ưu SEO (public)
// =======================
Route::get('/', [BuyerHomeController::class, 'index'])->name('buyer.home');
Route::get('/san-pham', [BuyerProductController::class, 'index'])->name('buyer.products');
Route::get('/san-pham/{slug}', [BuyerProductController::class, 'show'])->name('buyer.products.show');
Route::get('/danh-muc/{slug}', [BuyerCategoryController::class, 'show'])->name('danh-muc');
Route::get('/san-pham-noi-bat', [BuyerProductController::class, 'featured'])->name('buyer.featuredProducts');

// Thanh toán giỏ hàng
Route::get('/thanh-toan/gio-hang', [BuyerOrderController::class, 'checkoutCart'])->name('checkout.cart');
Route::post('/thanh-toan/gio-hang', [BuyerOrderController::class, 'processCart'])->name('checkout.process.cart');

Route::middleware(['auth'])->group(function () {
    // Thanh toán
    Route::get('/mua-ngay/{slug}', [BuyerOrderController::class, 'checkout'])->name('buyer.checkout.form');
    Route::post('/mua-ngay/{slug}', [BuyerOrderController::class, 'processPayment'])->name('buyer.checkout.process');
    Route::get('/thanh-toan', [BuyerOrderController::class, 'checkoutCart'])->name('checkout.form');
    Route::post('/thanh-toan', [BuyerOrderController::class, 'processCart'])->name('checkout.process');
});

// ========== CHUẨN HÓA PHẦN GIỎ HÀNG TRUYỀN THỐNG ==========
// Trang giỏ hàng
Route::get('/gio-hang', [BuyerOrderController::class, 'cartView'])->name('cart.index');
// Thêm sản phẩm vào giỏ hàng
Route::post('/gio-hang/them', [BuyerOrderController::class, 'cartAdd'])->name('cart.add');
// Xóa sản phẩm khỏi giỏ hàng
Route::post('/gio-hang/xoa', [BuyerOrderController::class, 'cartRemove'])->name('cart.remove');
// ========== END GIỎ HÀNG ==========

// ======================= ADMIN LOGIN =======================
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminAuthController::class, 'login']);
});

// =======================
// 🔐 Buyer Routes (require auth)
// =======================
Route::middleware(['auth'])->prefix('buyer')->name('buyer.')->group(function () {
    Route::get('/profile', [BuyerProfileController::class, 'edit'])->name('profile');
    Route::get('/orders', [BuyerOrderController::class, 'index'])->name('orders');
});

// ajax
Route::get('/ajax/products/filter', [App\Http\Controllers\Buyer\BuyerProductController::class, 'ajaxFilter'])
     ->name('ajax.filter.products');

Route::get('/api/cart-count', function () {
    $cart = session('cart', []);
    return response()->json([
        'count' => collect($cart)->sum('quantity'),
    ]);
})->name('buyer.api.cart-count');
