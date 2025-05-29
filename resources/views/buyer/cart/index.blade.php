@extends('layouts.buyer')

@if(session('success'))
  <script>
    window.addEventListener('DOMContentLoaded', () => {
      window.dispatchEvent(new CustomEvent('toast', { detail: { message: '{{ session('success') }}' } }))
    })
  </script>
@endif


@section('content')
<div x-data="{ showConfirm: false, removeId: null }">
    <div class="max-w-2xl mx-auto my-10 bg-[#111827] p-6 rounded-2xl shadow-xl border border-[#374151]">
        <h2 class="text-2xl font-extrabold mb-7 text-[#00796B] flex items-center gap-2">
            <i class="fas fa-shopping-cart"></i> Giỏ hàng của bạn
        </h2>
        @if(count($cart) == 0)
            <div class="text-center text-gray-400 py-10">
                Giỏ hàng trống.<br>
                <a href="{{ route('buyer.products') }}" class="inline-block mt-4 px-4 py-2 rounded-xl bg-[#4FC3F7] text-[#111827] font-bold hover:bg-[#00796B] hover:text-white transition">
                    Khám phá sản phẩm
                </a>
            </div>
        @else
            <div class="divide-y divide-[#374151]">
                @foreach($cart as $item)
                    <div class="flex items-center gap-4 py-4 group hover:bg-[#1f2937] rounded-xl transition relative">
                        <img src="{{ asset('storage/' . $item['thumbnail']) }}"
                             class="w-16 h-16 object-cover rounded-2xl border border-[#374151] bg-[#E0F2F1] shadow-sm">
                        <div class="flex-1 min-w-0">
                            <div class="font-bold text-[#E0F2F1] truncate">{{ $item['name'] }}</div>
                            <div class="text-sm mt-1 text-gray-400">Số lượng: <b>{{ $item['quantity'] }}</b></div>
                            <div class="text-[#FFD54F] font-bold mt-1 text-base">
                                {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }} đ
                            </div>
                        </div>
                        <button
                            @click="showConfirm=true; removeId={{ $item['id'] }}"
                            class="text-[#EF5350] hover:bg-[#374151] rounded-xl px-3 py-2 font-bold text-xs transition-all duration-150 ml-3">
                            Xoá
                        </button>
                    </div>
                @endforeach
            </div>
            <div class="border-t border-[#374151] mt-6 pt-5">
                <div class="flex justify-between items-center mb-2">
                    <span class="text-base font-semibold text-[#E0F2F1]">Tổng cộng:</span>
                    <span class="text-xl font-bold text-[#4FC3F7]">
                        {{ number_format($total, 0, ',', '.') }} đ
                    </span>
                </div>
                <div class="flex justify-end">
                    <a href="{{ route('checkout.cart') }}"
                       class="bg-[#00796B] hover:bg-[#4FC3F7] text-white rounded-2xl px-8 py-3 font-bold text-base shadow mt-4 transition-all duration-150">
                        Thanh toán
                    </a>
                </div>
            </div>
        @endif

        {{-- Block gợi ý sản phẩm --}}
        @if(isset($suggested) && count($suggested))
        <div class="mt-10">
            <h3 class="text-lg font-bold mb-4 text-[#00796B] flex items-center gap-2"><i class="fas fa-fire"></i> Sản phẩm gợi ý</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                @foreach($suggested as $sp)
                    <a href="{{ route('buyer.products.show', $sp->slug) }}" class="flex items-center gap-3 p-3 bg-[#1f2937] rounded-xl hover:bg-[#374151] border border-[#374151] transition">
                        <img src="{{ asset('storage/' . $sp->thumbnail_path) }}" class="w-12 h-12 object-cover rounded-lg border border-[#374151]">
                        <div class="flex-1 min-w-0">
                            <div class="font-bold text-[#E0F2F1] truncate">{{ $sp->name }}</div>
                            <div class="text-[#FFD54F] font-bold">{{ number_format($sp->price, 0, ',', '.') }} đ</div>
                        </div>
                    </a>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    {{-- Popup xác nhận xoá --}}
    <div x-show="showConfirm" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-40">
        <div class="bg-[#111827] rounded-2xl shadow-2xl p-8 border border-[#374151] text-center max-w-sm w-full">
            <div class="text-2xl mb-4 text-[#EF5350]"><i class="fas fa-exclamation-circle"></i></div>
            <div class="mb-4 text-[#E0F2F1]">Bạn có chắc chắn muốn xoá sản phẩm này khỏi giỏ hàng?</div>
            <form :action="'{{ route('cart.remove') }}'" method="POST">
                @csrf
                <input type="hidden" name="id" :value="removeId">
                <button type="submit" class="bg-[#EF5350] hover:bg-[#374151] text-white px-5 py-2 rounded-xl font-bold mr-3">Xoá</button>
                <button type="button" @click="showConfirm=false" class="bg-[#4FC3F7] text-[#111827] px-5 py-2 rounded-xl font-bold">Huỷ</button>
            </form>
        </div>
    </div>
</div>
@endsection
