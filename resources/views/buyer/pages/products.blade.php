
@extends('layouts.buyer')

@section('content')
<div class="max-w-7xl mx-auto px-4 md:px-6 py-8 grid grid-cols-1 md:grid-cols-4 gap-8">

    {{-- Sidebar --}}
    <aside class="space-y-10 md:sticky md:top-24 self-start">
        <x-category-sidebar :categories="$categories" />
        <x-filter-form />
    </aside>

    {{-- Nội dung sản phẩm --}}
    <section class="md:col-span-3 space-y-12">

        {{-- Sản phẩm nổi bật --}}
        <div class="space-y-6">
            <h2 class="text-xl font-semibold flex items-center gap-2">🔥 Sản phẩm nổi bật</h2>
            <x-featured-products :products="$featuredProducts" />
        </div>

        {{-- Danh sách tất cả sản phẩm --}}
        <div class="space-y-6">
            <h2 class="text-xl font-semibold flex items-center gap-2">📚 Tất cả sản phẩm</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($allProducts as $product)
                    <x-product-list-item :product="$product" />
                @endforeach
            </div>

            {{-- Phân trang nếu dùng paginate --}}
            <div class="mt-6">
                {{ $allProducts->links() }}
            </div>
        </div>

    </section>
</div>
@endsection
