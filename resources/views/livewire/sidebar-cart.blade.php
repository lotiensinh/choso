<div 
    x-data 
    class="fixed inset-0 z-[9999]"
    x-init="$watch('open', val => { if (!val) $el.remove() })"
>
    {{-- Overlay --}}
    <div 
        class="absolute inset-0 bg-black bg-opacity-40"
        @click="$el.closest('#sidebar-container').innerHTML = ''"
    ></div>

    {{-- Sidebar --}}
    <div 
        class="absolute right-0 top-0 w-80 h-full bg-[#111827] text-white shadow-lg border-l border-[#374151]"
        x-data="{ open: true }"
    >
        {{-- Header --}}
        <div class="flex justify-between items-center px-4 py-3 border-b border-gray-700">
            <h2 class="font-semibold text-lg">🛒 Giỏ hàng</h2>
            <button 
                @click="$el.closest('#sidebar-container').innerHTML = ''" 
                class="text-gray-400 hover:text-red-400 text-xl"
            >×</button>
        </div>

        {{-- Product List --}}
        <div class="p-4 space-y-4 text-sm max-h-[75vh] overflow-y-auto">
            @forelse ($cart as $item)
                <div wire:key="cart-{{ $item['id'] }}" class="flex items-start gap-3 border-b border-[#374151] pb-3">
                    <img src="{{ asset('storage/' . $item['thumbnail']) }}" class="w-14 h-14 rounded object-cover border border-gray-600">
                    <div class="flex-1">
                        <div class="font-semibold text-[#E0F2F1]">{{ $item['name'] }}</div>

                        <div class="flex items-center gap-2 text-gray-400 text-xs mt-1">
                            <button wire:click="decrease({{ $item['id'] }})" class="px-2 py-0.5 bg-[#374151] rounded hover:bg-[#4B5563]">−</button>
                            <span>{{ $item['quantity'] }}</span>
                            <button wire:click="increase({{ $item['id'] }})" class="px-2 py-0.5 bg-[#374151] rounded hover:bg-[#4B5563]">+</button>
                        </div>

                        <div class="text-[#4FC3F7] font-semibold">{{ number_format($item['price'] * $item['quantity']) }} đ</div>
                        <button wire:click="remove({{ $item['id'] }})" class="text-red-400 hover:underline text-xs mt-1">Xoá</button>
                    </div>
                </div>
            @empty
                <div class="text-center text-gray-500 py-10">Giỏ hàng trống</div>
            @endforelse
        </div>

        {{-- Total + Checkout --}}
        <div class="p-4 border-t border-[#374151]">
            <div class="flex justify-between font-bold text-[#00796B] mb-3">
                <span>Tổng:</span>
                <span>{{ number_format($total) }} đ</span>
            </div>
            <a href="{{ route('checkout.cart') }}"
               class="block w-full text-center bg-[#00796B] hover:bg-[#009688] text-white py-2 rounded font-semibold">
                Thanh toán
            </a>
        </div>
    </div>
</div>
