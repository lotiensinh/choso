{{-- components/product-grid.blade.php --}}
<div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-6">
    @foreach($products as $product)
        @livewire('product-list-item', ['product' => $product], key($product->id))
    @endforeach
</div>

@if($products->isEmpty())
    <p class="text-center text-gray-400 mt-6">Hiện chưa có sản phẩm nào phù hợp.</p>
@endif

{{-- Phân trang --}}
@if($products instanceof \Illuminate\Pagination\LengthAwarePaginator)
    <div class="mt-8 pb-10 flex justify-center">
        {{ $products->withQueryString()->links() }}
    </div>
@endif
