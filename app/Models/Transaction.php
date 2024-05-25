<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    protected $fillable = [
        'added_by',
        'business_id',
        'type',
        'category',
        'order_id',
        'expense_id',
        'wage_id',
        'amount',
        'note',
        'status',
        'cancel_reason',
        'method',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
