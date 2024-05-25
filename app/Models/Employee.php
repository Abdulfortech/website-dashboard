<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'business_id',
        'firstName',
        'middleName',
        'lastName',
        'dob',
        'gender',
        'maritalStatus',
        'phone1',
        'phone2',
        'email',
        'address',
        'state',
        'lga',
        'idType',
        'idNumber',
        'idPicture',
        'picture',
        'accountName',
        'accountNumber',
        'accountBank',
        'guarantorName',
        'guarantorRelation',
        'guarantorPhone1',
        'guarantorPhone2',
        'guarantorAddress',
        'employeeID',
        'employmentDate',
        'department',
        'role',
        'status',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
