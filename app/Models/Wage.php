<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wage extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'added_by',
        'department',
        'employee_id',
        'type',
        'method',
        'amount',
        'note',
        'date',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'added_by');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id');
    }
}
