<?php

use Illuminate\Database\Seeder;

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
            'name' => 'vi',
            'id_card' => '1800300184194',
            'gender' => 'female',
            'email' => 'vi@example.com',
            'role' => 'admin',
            'type' => 'general',           
            'password' => bcrypt('123456'),
        ]);
        DB::table('users')->insert([
            'name' => 'sakura',
            'id_card' => '1900300184194',
            'gender' => 'male',
            'email' => 'sakura@example.com',
            'role' => 'user',
            'type' => 'general',
            'image' => 'default.jpg',
            'password' => bcrypt('123456'),
        ]);
    
    }
}
