<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>"admin",
            'email'=>"admin@admin.com",
            'password'=>bcrypt('123456'),
            "image" => "temp/adminphoto",
            "banned" => 0,
         ]);
    }
}
