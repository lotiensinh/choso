<?php

namespace App\Livewire;

use Livewire\Component;

class AddToCartButton extends Component
{
    public $product;

    public function addToCart()
    {
        $cart = session()->get('cart', []);
        $productId = $this->product->id;
        $found = false;

        foreach ($cart as &$item) {
            if ($item['id'] == $productId) {
                $item['qty'] = ($item['qty'] ?? 1) + 1;
                $found = true;
                break;
            }
        }
        unset($item);

        if (!$found) {
            $cart[] = ['id' => $productId, 'qty' => 1];
        }
        session(['cart' => $cart]);

        $cartCount = collect($cart)->sum('qty');

        // Dispatch sự kiện để badge header update và toast, KHÔNG CẦN ->toBrowser() nữa!
        $this->dispatch('cartUpdated', cart_count: $cartCount);
        $this->dispatch('toast', message: $found ? '🛒 Đã tăng số lượng trong giỏ!' : '✅ Đã thêm vào giỏ hàng!');
    }

    public function render()
    {
        return view('livewire.add-to-cart-button');
    }
}
