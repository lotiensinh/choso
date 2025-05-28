<section class="text-white py-20 text-center relative overflow-hidden"
         style="background: linear-gradient(to right, #00796B, #4FC3F7);">
    <!-- Hiệu ứng nền mờ trái/phải -->
    <div class="absolute top-0 left-0 w-full h-full bg-no-repeat bg-left-top bg-contain opacity-10 pointer-events-none"
         style="background-image: url('/images/bg-circuit-left.png')"></div>
    <div class="absolute top-0 right-0 w-full h-full bg-no-repeat bg-right-top bg-contain opacity-10 pointer-events-none"
         style="background-image: url('/images/bg-box-right.png')"></div>

    <div class="max-w-screen-xl mx-auto px-4 relative z-10">
        <!-- Tiêu đề và mô tả -->
        <h1 class="text-3xl md:text-4xl font-extrabold leading-snug mb-4">
            Nền tảng sản phẩm số dành cho người Việt
        </h1>
        <p class="text-base md:text-lg text-[#E0F2F1] max-w-3xl mx-auto">
            Template, plugin, khóa học, tài liệu, mã nguồn... tất cả chỉ trong một nền tảng số duy nhất – Choso.io
        </p>

        <!-- Form tìm kiếm -->
        <form action="{{ route('buyer.products') }}" method="GET"
              class="mt-10 max-w-3xl mx-auto flex flex-col sm:flex-row rounded-2xl overflow-hidden shadow-xl bg-white">

            <!-- Ô nhập từ khóa -->
            <input type="text" name="q" placeholder="Tìm kiếm sản phẩm..."
                   class="flex-grow px-4 py-4 text-gray-800 text-base focus:outline-none placeholder-[#374151]" />

            <!-- Nút tìm kiếm -->
            <button type="submit"
                    class="bg-[#00796B] hover:bg-[#4FC3F7] text-white font-semibold px-6 py-4 flex items-center gap-2">
                <i class="fa-solid fa-magnifying-glass"></i>
                <span>Tìm kiếm</span>
            </button>
        </form>
    </div>
</section>
