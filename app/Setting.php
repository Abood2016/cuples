<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'site_name','email','phone','site_image','address',
        'facebook_url', 'twitter_url', 'instagram_url'
    ];
}
