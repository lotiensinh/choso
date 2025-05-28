@extends('layouts.buyer')

@section('title', $pageTitle)

@section('content')
<div class="bg-gray-900 text-white py-12">
    <div class="max-w-screen-xl mx-auto px-4">
        <h1 class="text-3xl font-bold mb-6">🌟 Sản phẩm nổi bật</h1>
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 xl:grid-cols-6 gap-4 items-stretch">
            @foreach ($products as $product)
                <x-product-card :product="$product" />
            @endforeach
        </div>

        <div class="mt-8">
            {{ $products->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
