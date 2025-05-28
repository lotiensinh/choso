@extends('layouts.buyer')

@section('content')
<div class="bg-[#111827] py-10 px-4 min-h-screen text-[#E0F2F1]">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-6">

        {{-- Sidebar --}}
        <div class="rounded-xl p-4 bg-[#1E293B] shadow-lg">
            <div class="font-bold text-white text-lg mb-4">Lịch sử mua hàng</div>
            <nav class="space-y-2 text-sm">
                <a href="#" class="flex items-center gap-2 px-4 py-2 bg-[#00796B] text-white rounded-lg">
                    📦 Đơn hàng của tôi
                </a>
                <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-[#374151] rounded-lg">
                    💸 Mã giảm giá
                </a>
                <a href="#" class="flex items-center gap-2 px-4 py-2 hover:bg-[#374151] rounded-lg">
                    🎮 Sản phẩm đã mua
                </a>
                <hr class="my-2 border-[#374151]">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full text-left text-[#EF5350] px-4 py-2 hover:underline">
                        ⛔ Đăng xuất
                    </button>
                </form>
            </nav>
        </div>

        {{-- Main Content --}}
        <div class="md:col-span-3 space-y-6">
            @forelse($orders as $order)
                <div class="bg-white rounded-xl p-5 shadow flex flex-col md:flex-row items-center gap-4 text-[#111827]">
                    <img src="{{ asset('storage/' . ($order->product->thumbnail_path ?? 'images/default-thumbnail.png')) }}"
                         class="w-24 h-24 rounded-lg object-cover border border-[#374151]">

                    <div class="flex-1 space-y-1">
                        <div class="text-xs text-gray-500">
                            Mã đơn: #{{ $order->id }} • {{ $order->created_at->format('d/m/Y H:i') }}
                        </div>
                        <div class="font-semibold text-base">{{ $order->product->name ?? '[Sản phẩm đã xoá]' }}</div>
                        <div class="text-sm text-gray-600">👤 Người bán: {{ $order->product->user->name ?? 'Ẩn danh' }}</div>
                    </div>

                    <div class="flex flex-col items-end gap-2 text-sm">
                        <div class="text-lg font-bold text-[#FFD54F]">
                            {{ number_format($order->product->price ?? 0) }}₫
                        </div>
                        <span class="px-3 py-1 rounded-full font-medium text-xs
                            {{ $order->is_paid ? 'bg-green-600 text-white' : 'bg-yellow-500 text-white' }}">
                            {{ $order->is_paid ? 'Đã thanh toán' : 'Chưa thanh toán' }}
                        </span>
                        <div class="flex gap-2">
                            <a href="#" class="px-3 py-1 bg-[#4FC3F7] text-[#111827] text-xs rounded hover:brightness-110">
                                💬 Liên hệ người bán
                            </a>
                            <a href="#" class="px-3 py-1 bg-[#4FC3F7] text-[#111827] text-xs rounded hover:brightness-110">
                                Quản lý đơn
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="bg-white rounded-xl p-6 text-center text-gray-600 shadow">
                    Bạn chưa có đơn hàng nào.
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection
