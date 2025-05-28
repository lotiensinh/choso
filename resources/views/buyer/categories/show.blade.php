@extends('layouts.buyer')

@section('title', 'Danh mục: ' . $category->name)

@section('content')
<div class="bg-gray-900 text-white">
    {{-- Header + Search --}}
    <div class="bg-gray-800 py-6 px-4 sm:px-8">
        <h1 class="text-3xl font-bold mb-2">🛍 Danh mục: {{ $category->name }}</h1>
        <x-search-bar />
    </div>

    {{-- Slide Sản phẩm nổi bật --}}
    <div class="py-8 px-4 sm:px-8 max-w-screen-xl mx-auto">
        <x-featured-products-section :featuredProducts="$featuredProducts" />
    </div> 

    {{-- Danh mục + Filter + Sản phẩm --}}
    <div class="py-8 px-4 sm:px-8 bg-dark-800">
        <div class="max-w-screen-xl mx-auto">
            <div class="flex flex-col md:flex-row gap-6">
                {{-- Cột trái (Sidebar + Filter) --}}
                <div class="w-full md:w-64 space-y-6">
                    <x-category-sidebar :categories="$categories" />
                    <x-filter-form :categories="$categories" />
                </div>

                {{-- Cột phải (Danh sách sản phẩm) --}}
                <div class="flex-1">
                    <h3 class="text-lg font-semibold mb-4">🛍 Tất cả sản phẩm</h3>

                    @include('components.product-grid', ['products' => $products])
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
