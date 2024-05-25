<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    use HasFactory;
    protected $table = 'business';
    protected $fillable = [
        'admin_id',
        'name',
        'motto',
        'abbreviation',
        'category',
        'phone1',
        'phone2',
        'email',
        'address',
        'state',
        'lga',
        'accountName',
        'accountNumber',
        'accountBank',
        'logo',
        'latterHead',
        'status',
        'password',
    ];
}
