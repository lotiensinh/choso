@extends('layouts.buyer')

@section('title', 'Trang chủ')

@section('content')
<div class="bg-gray-900 text-white">

    <!-- Banner + Search -->
            <x-search-bar />
    <!-- Sản phẩm nổi bật -->
    <div class="py-8 px-4 sm:px-8 max-w-screen-xl mx-auto">
        <x-featured-products-section :featuredProducts="$featuredProducts" />
    </div>

    <!-- Divider + tiêu đề -->
    <div class="bg-dark-800 border-t border-[#374151]">
        <div class="max-w-screen-xl mx-auto px-4 sm:px-8 py-6">
            <h2 class="text-x font-semibold text-center text-white mb-4">🛍 Tất cả sản phẩm</h2>
        </div>
    </div>

    <!-- Livewire filter -->
<div class="py-8 px-4 sm:px-8 bg-dark-800">
    <div class="max-w-screen-xl mx-auto">
        
    </div>
</div>

</div>

<!-- Hiệu ứng icon bay vào giỏ hàng -->
<script>
    window.addEventListener('add-to-cart-animation', event => {
        const productImage = document.querySelector(`#product-${event.detail.productId} img`);
        const cartIcon = document.querySelector('#cart-icon');
        if (!productImage || !cartIcon) return;

        const flyingImg = productImage.cloneNode(true);
        flyingImg.classList.add('fixed', 'z-50', 'transition-all', 'duration-700', 'rounded-full');
        const rectStart = productImage.getBoundingClientRect();
        const rectEnd = cartIcon.getBoundingClientRect();

        flyingImg.style.left = rectStart.left + 'px';
        flyingImg.style.top = rectStart.top + 'px';
        flyingImg.style.width = rectStart.width + 'px';
        flyingImg.style.height = rectStart.height + 'px';
        document.body.appendChild(flyingImg);

        requestAnimationFrame(() => {
            flyingImg.style.left = rectEnd.left + 'px';
            flyingImg.style.top = rectEnd.top + 'px';
            flyingImg.style.width = '0px';
            flyingImg.style.height = '0px';
            flyingImg.style.opacity = 0;
        });

        setTimeout(() => flyingImg.remove(), 800);
    });
</script>

<!-- Toast thông báo -->
<div
    x-data="{ show: false, message: '' }"
    x-show="show"
    x-transition
    x-init="
        Livewire.on('show-toast', msg => {
            message = msg;
            show = true;
            setTimeout(() => show = false, 2000);
        })
    "
    class="fixed top-6 right-6 bg-[#4FC3F7] text-black px-4 py-2 rounded shadow-lg text-sm z-50">
    <span x-text="message"></span>
</div>
@endsection
