@extends('layouts.buyer')

@section('content')
    <div class="max-w-2xl mx-auto p-6 bg-white rounded-lg shadow">
        <h2 class="text-xl font-bold mb-4">👤 Thông tin cá nhân</h2>

        <div class="space-y-2 text-gray-800">
            <p><strong>Họ tên:</strong> {{ $user->name }}</p>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Ngày tạo tài khoản:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
        </div>
    </div>
@endsection
