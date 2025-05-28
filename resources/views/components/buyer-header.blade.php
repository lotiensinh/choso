<header class="bg-gray-900 border-b border-gray-700 shadow-sm sticky top-0 z-50">
    {{-- Top bar --}}
    <div class="bg-[#1F2937]">
        <div class="max-w-screen-xl mx-auto px-4 py-2 flex items-center justify-between text-sm text-gray-300">
            <div class="hidden md:flex gap-4">
                <a href="#" class="hover:text-[#00796B]">Người mua</a>
                <a href="#" class="hover:text-[#00796B]">Người bán</a>
                <a href="#" class="hover:text-[#00796B]">Cộng tác viên</a>
            </div>
            <div class="flex items-center gap-3 text-xs md:text-sm">
                <span>VNĐ</span>
                <span class="text-gray-500">•</span>
                <span>Tiếng Việt</span>
                <i class="fas fa-globe"></i>
                <i class="fas fa-moon ml-2"></i>
            </div>
        </div>
    </div>

    {{-- Main bar --}}
    <div class="max-w-screen-xl mx-auto px-4 py-4 flex items-center justify-between gap-2 flex-wrap md:flex-nowrap">
        {{-- Logo --}}
        <a href="{{ route('buyer.home') }}" class="flex items-center">
            <img src="{{ asset('images/logo-choso.png') }}" alt="Choso logo" class="h-12 w-auto">
        </a>



        {{-- Menu chính --}}
        <nav class="hidden md:flex items-center justify-center gap-6 md:text-lg font-semibold text-white flex-1">
            <a href="{{ route('buyer.home') }}" class="{{ request()->is('/') ? 'text-[#FFD54F]' : 'hover:text-[#FFD54F]' }}">Trang chủ</a>
            <a href="{{ route('buyer.products') }}" class="{{ request()->is('san-pham') ? 'text-[#FFD54F]' : 'hover:text-[#FFD54F]' }}">Sản phẩm</a>
            <a href="{{ route('buyer.orders') }}" class="{{ request()->is('buyer/orders') ? 'text-[#FFD54F]' : 'hover:text-[#FFD54F]' }}">Đơn hàng</a>
            <a href="/lien-he" class="hover:text-[#FFD54F]">Liên hệ</a>
        </nav>

        {{-- Action buttons --}}
        @auth
        <div x-data="{ open: false }" class="relative">
            <button @click="open = !open"
                    class="flex items-center gap-2 text-white hover:text-[#FACC15] focus:outline-none">
                <img src="{{ Auth::user()->avatar ? asset('storage/' . Auth::user()->avatar) : asset('images/default-avatar.png') }}"
                     alt="avatar" class="w-8 h-8 rounded-full object-cover">
                <span class="text-sm">{{ Auth::user()->name }}</span>
                <i class="fas fa-chevron-down text-xs"></i>
            </button>

            <div x-show="open"
                 @click.away="open = false"
                 x-transition
                 class="absolute right-0 mt-2 bg-white rounded shadow-lg text-black min-w-[160px] z-50">
                <a href="{{ route('buyer.profile') }}" class="block px-4 py-2 hover:bg-gray-100">👤 Hồ sơ</a>
                <a href="{{ route('buyer.orders') }}" class="block px-4 py-2 hover:bg-gray-100">📦 Đơn hàng</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left px-4 py-2 hover:bg-gray-100">🚪 Đăng xuất</button>
                </form>
            </div>
        </div>
        @endauth

        @guest
            {{-- <a href="{{ route('login') }}" class="text-white hover:text-[#FACC15]">Đăng nhập</a> --}}
            {{-- <a href="{{ route('register') }}" class="text-white hover:text-[#FACC15]">Đăng ký</a> --}}
        @endguest

{{-- Cart icon with live count --}}
<div class="flex items-center gap-2 sm:gap-3 text-xs sm:text-sm">
    <a href="javascript:void(0)" onclick="window.dispatchEvent(new Event('toggle-cart'))"
       class="relative flex items-center justify-center bg-gray-800 border border-gray-700 hover:border-[#00796B] rounded-lg px-3 py-2">
        <i id="cart-icon" class="fas fa-shopping-cart text-white text-lg"></i>
        <span 
            id="cart-count"
            x-data="{ count: {{ session('cart') ? collect(session('cart'))->sum('quantity') : 0 }} }"
            x-init="
                window.addEventListener('cartUpdated', () => {
                    fetch('{{ route('buyer.api.cart-count') }}')
                        .then(res => res.json())
                        .then(data => count = data.count)
                })
            "
            x-text="count"
            class="absolute -top-1 -right-1 bg-red-600 text-white text-[10px] min-w-[18px] h-[18px] px-1 rounded-full flex items-center justify-center leading-none"
        ></span>
    </a>
</div>


</div>

    {{-- Danh mục ngang --}}
    @if(isset($categories) && count($categories) > 0)
    <div class="bg-gray-800 border-t border-gray-700 overflow-x-auto">
        <div class="max-w-screen-xl mx-auto px-4 py-2 flex gap-5 text-sm text-gray-300 whitespace-nowrap">
            @foreach($categories as $category)
                <a href="{{ route('danh-muc', $category->slug) }}"
                   class="hover:text-[#00796B] flex items-center gap-1">
                    @if(!empty($category->icon)) <i class="{{ $category->icon }}"></i> @endif
                    {{ $category->name }}
                </a>
            @endforeach
        </div>
    </div>
    @endif
</header>
