<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'test',
            'email' => 'test@test.com',
            'permission' => 'مدير',
            'email_verified_at' => now(),
            'password' => bcrypt('123123123'), // password
            'remember_token' => Str::random(10),
        ]);
    }
}