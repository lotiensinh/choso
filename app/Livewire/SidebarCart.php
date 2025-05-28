<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

#[On('cartUpdated')]
class SidebarCart extends Component
{
    public $cart = [];

    protected $listeners = ['cart-updated' => 'refreshCart'];

    public function mount()
    {
        $this->refreshCart();
    }

    public function refreshCart()
    {
        $this->cart = session()->get('cart', []);
    }

    public function increase($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            $cart[$productId]['quantity']++;
            session()->put('cart', $cart);
        }
        $this->refreshCart();
    }

    public function decrease($productId)
    {
        $cart = session()->get('cart', []);
        if (isset($cart[$productId])) {
            if ($cart[$productId]['quantity'] > 1) {
                $cart[$productId]['quantity']--;
            } else {
                unset($cart[$productId]);
            }
            session()->put('cart', $cart);
        }
        $this->refreshCart();
    }

    public function remove($productId)
    {
        $cart = session()->get('cart', []);
        unset($cart[$productId]);
        session()->put('cart', $cart);
        $this->refreshCart();
    }

    public function render()
    {
        $total = collect($this->cart)->sum(fn ($item) => $item['price'] * $item['quantity']);
        return view('livewire.sidebar-cart', [
            'cart' => $this->cart,
            'total' => $total,
        ])->layout(null);
    }
}

