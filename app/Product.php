<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    protected $fillabel = [
        'title', 'product_cover', 'video',
        'price', 'contact_info' , 'category_id' , 'user_id' , 'admin_id'

    ];


    use SoftDeletes;

    public function books()
    {
        return $this->belongsToMany(Booking::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Product_Image::class);
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

}
