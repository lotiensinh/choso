@extends('layouts.buyer')

@section('title', $product->name)

@section('content')
<div class="max-w-screen-xl mx-auto px-4 py-10 text-white grid grid-cols-1 md:grid-cols-2 gap-12">
  <!-- Ảnh sản phẩm -->
  <div>
    <img src="{{ asset('storage/' . $product->thumbnail_path) }}" alt="{{ $product->name }}" class="rounded-xl w-full shadow-md">
  </div>

  <!-- Thông tin sản phẩm -->
  <div class="space-y-4">
    <h1 class="text-3xl font-bold">{{ $product->name }}</h1>
    <p class="text-lg text-gray-300">{{ $product->short_description }}</p>
    <div class="text-2xl font-semibold text-teal-400">{{ number_format($product->price, 0, ',', '.') }}đ</div>

    <form action="{{ url('/thanh-toan/' . $product->slug) }}" method="GET" class="mt-6">
  <button class="bg-teal-500 hover:bg-teal-600 text-white font-bold py-3 px-6 rounded-xl transition-all">
    Mua ngay
  </button>
</form>


    @if($product->reviews_count > 0)
      <div class="text-sm text-gray-400 mt-4">
        ★ {{ number_format($product->reviews_avg_rating, 1) }} / 5 ({{ $product->reviews_count }} đánh giá)
      </div>
    @endif
  </div>
</div>

<!-- Tabs nội dung -->
<div class="max-w-screen-xl mx-auto px-4 py-8 text-white">
  <div class="border-b border-gray-700 mb-6">
    <ul class="flex space-x-6 text-sm font-medium">
      <li><a href="#mo-ta" class="hover:text-teal-400">📄 Mô tả</a></li>
      <li><a href="#danh-gia" class="hover:text-teal-400">⭐ Đánh giá</a></li>
    </ul>
  </div>

  <!-- Mô tả -->
  <div id="mo-ta" class="prose prose-invert max-w-none">
    {!! $product->description !!}
  </div>

  <!-- Đánh giá -->
  <div id="danh-gia" class="mt-12">
    <h2 class="text-xl font-bold mb-4">Đánh giá từ người dùng</h2>
    @forelse ($product->reviews as $review)
      <div class="border-t border-gray-700 py-4">
        <div class="text-sm text-gray-300">{{ $review->user->name ?? 'Ẩn danh' }} - ★ {{ $review->rating }}/5</div>
        <div>{{ $review->comment }}</div>
      </div>
    @empty
      <p class="text-gray-400">Chưa có đánh giá nào.</p>
    @endforelse
  </div>
</div>
@endsection
