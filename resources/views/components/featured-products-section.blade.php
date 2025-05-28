@props(['featuredProducts'])

<section class="py-16 bg-[#111827] text-white">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-bold">Sản phẩm nổi bật</h2>
            <a href="{{ route('buyer.featuredProducts', ['filter' => 'featured']) }}"
               class="text-[#4FC3F7] hover:underline font-medium">Xem tất cả</a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-6 gap-4 items-stretch">
            @foreach($featuredProducts as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>

        {{-- Phân trang tùy chỉnh --}}
        @if($featuredProducts instanceof \Illuminate\Pagination\LengthAwarePaginator)
            <div class="flex justify-center items-center gap-4 mt-8">
                @if($featuredProducts->onFirstPage())
                    <span class="opacity-30 px-4 py-2">&larr;</span>
                @else
                    <a href="{{ $featuredProducts->previousPageUrl() }}" class="px-4 py-2 bg-[#374151] rounded hover:bg-[#00796B]">&larr;</a>
                @endif

                <span class="text-sm text-gray-300">
                    Trang {{ $featuredProducts->currentPage() }} / {{ $featuredProducts->lastPage() }}
                </span>

                @if($featuredProducts->hasMorePages())
                    <a href="{{ $featuredProducts->nextPageUrl() }}" class="px-4 py-2 bg-[#374151] rounded hover:bg-[#00796B]">&rarr;</a>
                @else
                    <span class="opacity-30 px-4 py-2">&rarr;</span>
                @endif
            </div>
        @endif
    </div>
</section>