<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'added_by',
        'department',
        'title',
        'amount',
        'note',
        'date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }
}
