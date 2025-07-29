<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable =[
        'cat_name',
        'cat_description',
        'cat_image'
    ];
    public function products()
{
    return $this->hasMany(Product::class);
}

}
