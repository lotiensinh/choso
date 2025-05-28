@extends('layouts.buyer')

@section('title', 'Danh sách sản phẩm')

@section('content')
    <div class="text-white px-4 py-8 max-w-6xl mx-auto">
        <h1 class="text-2xl font-bold mb-6">📦 Tất cả sản phẩm</h1>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @forelse($products as $product)
                <div class="bg-gray-800 p-4 rounded shadow">
                    <img src="{{ asset('storage/' . $product->thumbnail_path) }}" alt="{{ $product->name }}" class="w-full h-40 object-cover rounded mb-2">
                    <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                    <p class="text-sm text-gray-300">{{ number_format($product->price) }}₫</p>
                    <a href="{{ route('buyer.products.show', $product->slug) }}" class="text-teal-400 hover:underline text-sm">Xem chi tiết</a>
                </div>
            @empty
                <p>Không có sản phẩm nào.</p>
            @endforelse
        </div>
    </div>
@endsection
