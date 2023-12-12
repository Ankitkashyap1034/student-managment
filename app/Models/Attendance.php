<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;

    protected $table = 'attendance';

    protected $primary_key = 'id';

    protected $fillable =
    [
        'student_id',
        'status',
        'staff_id',
        'day',
        'month',
        'year',
    ];

}
