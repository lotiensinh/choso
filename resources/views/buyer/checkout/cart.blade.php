@extends('layouts.buyer')

@section('title', 'Thanh toán giỏ hàng')

@section('content')
<div class="max-w-4xl mx-auto py-10 px-4 text-white">
    <h1 class="text-2xl font-bold mb-6">🧾 Xác nhận thanh toán</h1>

    <div class="bg-gray-800 p-6 rounded-xl shadow space-y-4 mb-8">
        @php $total = 0; @endphp
        @foreach($cart as $item)
            @php $subtotal = $item['price'] * $item['quantity']; $total += $subtotal; @endphp
            <div class="flex justify-between items-center border-b border-gray-700 pb-2">
                <div>
                    <h3 class="font-semibold">{{ $item['name'] }}</h3>
                    <p class="text-sm text-gray-400">x{{ $item['quantity'] }}</p>
                </div>
                <span class="text-[#00bfa5] font-bold">{{ number_format($subtotal) }}đ</span>
            </div>
        @endforeach
        <div class="flex justify-between text-lg font-bold pt-4 border-t border-gray-700">
            <span>Tổng cộng:</span>
            <span class="text-[#00bfa5]">{{ number_format($total) }}đ</span>
        </div>
    </div>

    <form action="{{ route('checkout.process.cart') }}" method="POST" enctype="multipart/form-data" class="bg-gray-800 p-6 rounded-xl shadow space-y-4">
        @csrf
        <div>
            <label for="email" class="block font-semibold mb-1">Email nhận sản phẩm</label>
            <input type="email" name="email" id="email" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white" required>
        </div>

        <div>
            <label for="screenshot" class="block font-semibold mb-1">Ảnh xác nhận thanh toán (Momo)</label>
            <input type="file" name="screenshot" id="screenshot" accept="image/*" class="w-full bg-gray-700 border border-gray-600 px-3 py-2 rounded text-white" required>
        </div>

        <button type="submit" class="w-full py-3 rounded text-white font-semibold text-lg" style="background-color: #00796B;">
            ✅ Gửi đơn hàng
        </button>
    </form>
</div>
@endsection
