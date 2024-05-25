<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    use HasFactory;
    protected $table = 'history';
    protected $fillable = [
        'business_id',
        'added_by',
        'department',
        'product_id',
        'quantity',
        'amount',
        'date',
        'status',
        'type',
        'cancel_reason',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
    
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
