<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PayFee extends Model
{
    use HasFactory;

    protected $table = 'student_fee';

    protected $primary_key = 'id';

    protected $fillable =
    [
        'mobile_no',
        'student_id',
        'fee_amount',
        'payment_mode',
        'remark',
        'staff_id',
    ];

    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
