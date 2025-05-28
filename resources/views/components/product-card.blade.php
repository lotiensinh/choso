@props(['product'])

<div id="product-{{ $product->id }}"
     class="group relative rounded-xl overflow-hidden bg-[#1f2937] shadow-lg hover:shadow-xl transition duration-300
            border-2 border-transparent hover:border-[3px] hover:border-gradient
            flex flex-col h-full min-h-[360px]
            [background-image:linear-gradient(#1f2937,#1f2937),linear-gradient(45deg,#FFD700,#FF69B4,#00FFFF,#FFD700)]
            [background-origin:border-box] [background-clip:padding-box,border-box]">

    <!-- Badge nổi bật -->
    <span class="absolute top-2 left-2 bg-[#FFD700] text-black text-xs font-semibold px-2 py-1 rounded-full shadow z-10">
        🌟 Nổi bật
    </span>

    <!-- Nội dung chính -->
    <a href="{{ route('buyer.products.show', $product->slug) }}" class="flex-1 flex flex-col">
        <img src="{{ asset('storage/' . $product->thumbnail_path) }}"
             alt="{{ $product->name }}"
             class="w-full h-40 object-cover"
             onerror="this.src='{{ asset('images/default-thumbnail.png') }}'">

        <div class="p-3 flex flex-col gap-1 text-white text-sm">
            <h3 class="font-semibold leading-tight line-clamp-2 min-h-[36px]">{{ $product->name }}</h3>
            <p class="text-gray-400 text-xs line-clamp-1">Seller: {{ $product->user->name ?? '---' }} @if(optional($product->category)->name) — {{ $product->category->name }} @endif</p>
            <p class="text-[#FFD54F] font-bold text-base">{{ number_format($product->price) }} Scoin</p>

            <!-- Review -->
            <p class="text-xs mt-1 {{ $product->reviews_count > 0 ? 'text-yellow-400' : 'text-gray-500' }}">
                @if($product->reviews_count > 0)
                    ★ {{ number_format($product->reviews_avg_rating, 1) }} / 5 ({{ $product->reviews_count }})
                @else
                    ☆ Chưa có đánh giá
                @endif
            </p>
        </div>
    </a>

    <!-- Hành động -->
<div class="flex justify-end items-center px-3 pb-3 mt-auto gap-2">
    <!-- Thêm giỏ hàng -->
    <livewire:add-to-cart-button :product="$product" :key="$product->id" />

    <!-- Mua ngay -->
    <a href="{{ route('buyer.checkout.form', $product->slug) }}"
       class="bg-[#FFD54F] text-[#111827] py-1.5 px-3 rounded-lg text-sm font-semibold hover:bg-[#4FC3F7] transition">
        ⚡
    </a>
</div>


</div>
