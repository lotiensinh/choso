<button
    wire:click="addToCart"
    data-thumbnail="{{ asset('storage/' . $product->thumbnail_path) }}"
    class="add-to-cart-btn bg-[#00796B] text-[#E0F2F1] py-1.5 px-3 rounded-lg text-sm font-semibold hover:bg-[#374151] transition"
    title="Thêm vào giỏ hàng"
>
    🧺
</button>
