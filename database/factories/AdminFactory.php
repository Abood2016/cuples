<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Admin;
use Faker\Generator as Faker;
use Illuminate\Support\Facades\Hash;

$factory->define(Admin::class, function (Faker $faker) {
    return [
        'name' => 'AbedElRahman',
        'account_type' => 'admin',
        'email' => $faker->email,
        'address' => 'Gaza',
        'password' => Hash::make('123456'),
        'active' => '1'
    ];
});
