<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_id',
        'user_id',
        'name',
        'category',
        'phone1',
        'phone2',
        'email',
        'address',
        'status',
        'order_counting',
        'order_counting',
        'payment_counting',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
