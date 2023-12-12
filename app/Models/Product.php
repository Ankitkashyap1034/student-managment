<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'product';

    protected $primary_key = 'id';
    protected $casts = [
        'product_images' => 'array',
    ];

    protected $fillable =
    [
        'product_name',
        'category_id',
        'quantity',
        'description',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }
}
