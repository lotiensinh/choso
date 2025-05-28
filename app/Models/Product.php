<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'description',
        'price',
        'file_path',
        'thumbnail_path',
        'category_id',
        'is_approved',
    ];

    protected $appends = ['thumbnail_url'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(\App\Models\Order::class, 'product_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating()
    {
        return $this->reviews()->avg('rating');
    }

    public function reviewCount()
    {
        return $this->reviews()->count();
    }

    public function seller()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function getThumbnailUrlAttribute()
    {
        return $this->thumbnail_path
            ? asset('storage/' . str_replace('\\', '/', $this->thumbnail_path))
            : asset('images/default-thumbnail.jpg'); // fallback nếu chưa có ảnh
    }
}
