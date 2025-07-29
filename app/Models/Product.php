<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'category_id',
        'product_name',
        'product_description',
        'product_price',
        'product_discount',
        'product_image',
        'stock'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
