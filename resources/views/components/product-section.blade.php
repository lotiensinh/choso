<div class="flex flex-wrap justify-center gap-2 mb-10">
    <a href="/san-pham#tat-ca-san-pham"
       class="category-tab px-4 py-2 rounded-full text-sm font-semibold transition bg-[#00BFA5] text-white"
       data-slug="tat-ca-san-pham">
        Tất cả
    </a>

    @foreach ($categories as $category)
        <a href="{{ route('buyer.products', ['slug' => $category->slug]) }}#tat-ca-san-pham"
           class="category-tab px-4 py-2 rounded-full text-sm font-semibold transition bg-gray-700 text-gray-300 hover:bg-[#00BFA5] hover:text-white"
           data-slug="{{ $category->slug }}">
            {{ $category->name }}
        </a>
    @endforeach
</div>

{{-- Danh sách sản phẩm --}}
<div id="product-area">
    @include('components.product-grid', ['products' => $products])
</div>
