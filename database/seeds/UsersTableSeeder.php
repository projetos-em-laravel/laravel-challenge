<?php

use App\Models\User;
use Illuminate\Database\Seeder;

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
            'name'      =>  'Beltrano',
            'email'     =>  'beltrano@gmail.com',
            'password'  => bcrypt('123456'),
        ]);
        User::create([
            'name'      =>  'Fulano',
            'email'     =>  'fulano@gmail.com',
            'password'  => bcrypt('123456'),
        ]);
        User::create([
            'name'      =>  'Siclano',
            'email'     =>  'siclano@gmail.com',
            'password'  => bcrypt('123456'),
        ]);
    }
}
