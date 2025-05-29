<div>
    <div class="flex gap-2 mb-4">
        <button
            class="px-4 py-2 rounded-xl font-semibold @if($selectedCategory === null) bg-[#00796B] text-white @else bg-[#E0F2F1] text-[#111827] @endif"
            wire:click="selectCategory(null)">
            Tất cả sản phẩm
        </button>
        @foreach($categories as $cat)
            <button
                class="px-4 py-2 rounded-xl font-semibold @if($selectedCategory == $cat->id) bg-[#4FC3F7] text-[#111827] @else bg-[#E0F2F1] text-[#111827] @endif"
                wire:click="selectCategory({{ $cat->id }})">
                {{ $cat->name }}
            </button>
        @endforeach
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
        @forelse($products as $product)
            <div class="rounded-xl border border-[#374151] bg-[#111827] shadow p-4">
                <div class="mb-3 font-bold text-lg text-[#00796B]">
                    {{ $product->name }}
                </div>
                <div class="mb-1 text-[#FFD54F] font-semibold">
                    {{ number_format($product->price) }} đ
                </div>
                <div class="mb-2 text-sm text-[#E0F2F1] line-clamp-2">
                    {!! strip_tags($product->description) !!}
                </div>
            </div>
        @empty
            <div class="col-span-4 text-center text-[#FFD54F] font-semibold py-10">Không có sản phẩm nào!</div>
        @endforelse
    </div>
    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>
