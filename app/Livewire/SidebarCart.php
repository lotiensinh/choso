<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

#[On('cartUpdated')]
class SidebarCart extends Component
{
    public $cart = [];

    public function mount()
    {
        $this->syncCart();
    }

    public function increase($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
            session()->put('cart', $cart);
            $this->toast('Đã tăng sản phẩm');
        }

        $this->syncCart();
    }

    public function decrease($productId)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$productId])) {
            if ($cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
                $this->toast('Đã giảm sản phẩm');
            } else {
                unset($cart[$productId]);
                $this->toast('Đã xoá sản phẩm');
            }

            session()->put('cart', $cart);
        }

        $this->syncCart();
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
        $this->toast('Đã xoá sản phẩm');

        $this->syncCart();
    }

    public function syncCart()
{
    $sessionCart = session()->get('cart', []);

    // ✅ Force Livewire detect change
    $this->cart = [];
    $this->cart = json_decode(json_encode($sessionCart), true);

    $this->dispatch('cartUpdated');
}

    public function cartUpdated()
    {
        $this->syncCart();
        $this->dispatch('$refresh');
    }

    public function toast($message)
    {
        $this->dispatch('toast', ['message' => $message]);
    }

    public function noop() {}

    public function render()
    {
        $total = collect($this->cart)->sum(fn ($item) => $item['price'] * $item['quantity']);

        return view('livewire.sidebar-cart', [
            'cart' => $this->cart,
            'total' => $total,
        ])->layout(null);
    }
}
