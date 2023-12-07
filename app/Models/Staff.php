<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Staff extends Model
{
    use HasFactory;
    protected $table = 'staff';
    protected $primary_key = 'id';
    protected $fillable =
    [
        'name',
        'email',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'user_id', 'id');
    }
}
