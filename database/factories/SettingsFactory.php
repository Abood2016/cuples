<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Setting;
use Faker\Generator as Faker;

$factory->define(Setting::class, function (Faker $faker) {
    return [
        'site_name' => 'Cupels',
        'email' => 'cuples@gmiail.com',
        'phone' => '0592663574',
        'address' => 'Gaza,Palestine,201',
        'site_image' => asset('empty.png'),
        'facebook_url' => 'www.facebook.com',
        'instagram_url' => 'www.instagram.com',
        'twitter_url' => 'www.twitter.com',
    ];
});
