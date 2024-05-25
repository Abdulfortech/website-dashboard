<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;
    protected $fillable = [
        'business_id',
        'addedBy',
        'firstName',
        'lastName',
        'username',
        'userType',
        'jurisdiction',
        'email',
        'password'
    ];

}
