<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'name',
        'email',
        'password',
        'wallet_balance',
        'role',           // ✅ cần thiết để lưu seller
        'status',         // ✅ để biết bị banned hay active
        'is_approved',    // ✅ chờ duyệt hay đã duyệt
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // 🧑 Sản phẩm của seller
    public function products()
    {
        return $this->hasMany(\App\Models\Product::class);
    }

    // 🛒 Đơn hàng của user (buyer hoặc seller đều có thể dùng)
    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class);
    }
}