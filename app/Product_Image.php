<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product_Image extends Model
{
    use SoftDeletes;

    protected $fillabel = ['image', 'product_id'];


    public function products()
    {
        return $this->belongsTo(Product::class);
    }
}
