<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'added_by',
        'department',
        'order_id',
        'order_code',
        'item_name',
        'item_type',
        'item_id',
        'quantity',
        'price',
        'total',
        'status',
    ];
}
