<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'email' => 'applocumadmin@yopmail.com',
            'name' => 'Admin',
            'password' => bcrypt('Password@123'),
            'is_admin' => 1,
        ]);
    }
}
