<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    protected $fillable = [
        'name',
        'phone',
        'address',
        'city',
        'state',
        'pin_code',
        'total_price',
        'payment_method',
        'payment_id',
        'status'
    ];
    public function items()
    {
        return $this->hasMany(order_items::class, 'order_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
