<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'user_id',
        'title',
        'code',
        'category',
        'department',
        'price',
        'image1',
        'description',
        'status',
    ];
}
