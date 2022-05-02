<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Admin::insert([
            'admin_name' =>"Super Admin",
            'email' =>"admin@gmail.com",
            'password' =>bcrypt('password'),
            'created_at' =>now(),
            'updated_at' =>now(),
        ]);
    }
}
