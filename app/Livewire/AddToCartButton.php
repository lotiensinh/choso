<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;

class AddToCartButton extends Component
{
    public Product $product;

public function addToCart()
{
    $cart = session()->get('cart', []);

    if (isset($cart[$this->product->id])) {
        $cart[$this->product->id]['quantity']++;
    } else {
        $cart[$this->product->id] = [
            'id' => $this->product->id,
            'name' => $this->product->name,
            'price' => $this->product->price,
            'thumbnail' => $this->product->thumbnail_path,
            'quantity' => 1,
        ];
    }

    session()->put('cart', $cart);

    // ✅ Gửi toast
    $this->dispatch('toast', message: '🧺 Đã thêm vào giỏ hàng');

    // ✅ Gửi hiệu ứng bay icon (frontend dùng để show animation)
    $this->dispatch('cart-fly', thumbnail: asset('storage/' . $this->product->thumbnail_path));

    // ✅ Gửi sự kiện để icon 🛒 cập nhật số lượng
    $this->dispatch('cartUpdated');

    // ✅ Nếu SidebarCart đang mở thì cập nhật lại nội dung
    $this->dispatch('$refresh', to: 'sidebar-cart');
}


    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
