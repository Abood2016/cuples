<?php

use Illuminate\Database\Seeder;
use App\Admin;
use App\Setting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
		//  factory(Admin::class, 20)->create();
        factory(Setting::class, 1)->create();
    }
}
