<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'user_id',
        'title',
        'code',
        'category',
        'brand',
        'department',
        'quantity',
        'cost',
        'wholesalePrice',
        'retailPrice',
        'receivedDate',
        'soldoutDate',
        'image1',
        'image2',
        'image3',
        'image4',
        'description',
        'status',
        'updated_by',
        'order_counting'
    ];

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    
}
