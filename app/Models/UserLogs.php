<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLogs extends Model
{
    use HasFactory;
    protected $table = 'user_logs';
    protected $fillable = [
        'user_id',
        'username',
        'IPAddress',
        'status',
    ];
}
