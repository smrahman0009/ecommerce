<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                'name'=>'miead',
                'email'=>'miead@gmail.com',
                'password'=>bcrypt('password'),
            ]
        );
    }
}
