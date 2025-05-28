<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'amount', 'method', 'account_number', 'account_name', 'is_approved',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
