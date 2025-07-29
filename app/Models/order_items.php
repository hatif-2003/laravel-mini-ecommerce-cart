<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order_items extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price'
    ];
    public function order()
    {
        return $this->belongsTo(orders::class, 'order_id'); // har order item ek order se belong karta hai
    }



    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
