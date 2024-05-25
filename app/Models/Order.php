<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'added_by',
        'department',
        'order_code',
        'client_id',
        'order_type',
        'client_name',
        'client_address',
        'client_phone',
        'subtotal',
        'quantity',
        'discount',
        'total',
        'deposit',
        'balance',
        'payment_status',
        'payment_balance',
        'cancel_reason',
        'collected_at',
        'sell_at',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
