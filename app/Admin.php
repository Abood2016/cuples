<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends  Authenticatable
{
    use SoftDeletes;

    protected $fillable = [
        'name','account_type','email','password',
        'address','image','active'];



    public function products(){
        return $this->hasMany(Product::class);
    }


    public function activity(){

        if ($this->active == '1') {

            return ' نشط الأن';

        }else {

            return  'معطل';
        }

    }
}
