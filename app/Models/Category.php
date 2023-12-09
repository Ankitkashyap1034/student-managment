<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $primary_key = 'id';
    protected $fillable =
    [
        'category_name',
        'order',
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id');
    }
}
