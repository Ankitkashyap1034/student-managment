<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
    protected $table = 'student';
    protected $primary_key = 'id';
    protected $fillable =
    [
        'profile_img',
        'name',
        'father_name',
        'mother_name',
        'mobile_no',
        'email',
        'gender',
        'class',
        'address',
        'password',
        'user_id',
        'created_by'
    ];

    public function studentFee()
    {
        return $this->hasOne(PayFee::class,'id');
    }
}
