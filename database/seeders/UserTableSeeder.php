<?php

namespace Database\Seeders;

use App\Domain\User\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::insert([
            ["name"=> "Admin user", 'email'=> 'admin@gmail.com', 'password'=> Hash::make("admin123"), 'role_id'=>1],
            ["name"=> "Normal user", 'email'=> 'usertest@gmail.com', 'password'=> Hash::make("user123456"), 'role_id'=>2]
        ]);
        User::factory(10)->create();


    }
}
