@extends('layouts.buyer')

@section('title', 'Thanh toán: ' . $product->name)

@section('content')
<div class="max-w-screen-md mx-auto py-10 text-white">
    <h1 class="text-2xl font-bold mb-6">💸 Thanh toán đơn hàng</h1>

    @if (session('success'))
        <div class="bg-green-600 text-white px-4 py-3 rounded mb-4 shadow">
            {{ session('success') }}
        </div>
    @endif

    <div class="bg-gray-800 p-6 rounded-xl shadow space-y-6">
        <div class="flex items-center space-x-4">
            <img src="{{ asset('storage/' . $product->thumbnail_path) }}" alt="{{ $product->name }}" class="w-20 h-20 object-cover rounded">
            <div>
                <h2 class="text-lg font-semibold">{{ $product->name }}</h2>
                <div class="text-sm text-gray-400">{{ number_format($product->price, 0, ',', '.') }} VNĐ</div>
            </div>
        </div>

        <form method="POST" action="{{ route('buyer.checkout.process', $product->slug) }}" enctype="multipart/form-data" class="space-y-4">
            @csrf

            <div>
                <label for="email" class="block text-sm font-semibold mb-1">Email nhận sản phẩm:</label>
                <input type="email" name="email" id="email" required
                       class="w-full bg-gray-700 border border-gray-600 rounded px-4 py-2 text-white">
            </div>

            <div>
                <label for="screenshot" class="block text-sm font-semibold mb-1">Ảnh chụp thanh toán Momo:</label>
                <input type="file" name="screenshot" id="screenshot" accept="image/*" required
                       class="w-full text-sm text-gray-300 file:bg-gray-700 file:border-none file:rounded file:px-4 file:py-2 file:text-white file:cursor-pointer">
            </div>

            <button type="submit"
                    class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded transition">
                ✅ Xác nhận thanh toán
            </button>
        </form>
    </div>
</div>
@endsection
