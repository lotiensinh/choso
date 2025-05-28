@extends('layouts.buyer')

@section('content')
<div class="max-w-xl mx-auto mt-8">
    <h2 class="text-xl font-bold mb-4">Thanh toán Momo</h2>

    <p>Sản phẩm: <strong>{{ $product->name }}</strong></p>
    <p>Giá: <strong class="text-red-500">{{ number_format($product->price) }} VNĐ</strong></p>

    <img src="{{ asset('qr-momo.png') }}" alt="QR Momo" class="w-60 my-4">

    <form action="{{ route('buyer.checkout.process', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="email" name="email" class="w-full border p-2 mb-3" placeholder="Nhập email nhận sản phẩm" required>
        <input type="file" name="payment_image" class="w-full mb-3" required>
        <button class="bg-purple-600 text-white px-4 py-2 rounded">Gửi xác nhận</button>
    </form>
</div>
@endsection
