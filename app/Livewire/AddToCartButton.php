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

        $this->dispatch('cartUpdated');
        $this->dispatch('cart-fly', thumbnail: asset('storage/' . $this->product->thumbnail_path));
        $this->dispatch('toast', message: '🧺 Đã thêm vào giỏ hàng');

        // ✅ ÉP sidebar-cart cập nhật ngay
        $this->dispatch('$refresh', to: 'sidebar-cart');
        $this->dispatch('force-refresh-sidebar');

    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
