<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        DB::table('users')->insert([
            'username' => 'admin',
            'password' => bcrypt('admin'),
            'tipo' => 'medio'
        ]);
        
        DB::table('users')->insert([
            'username' => 'normal',
            'password' => bcrypt('normal'),
            'tipo' => 'normal'
        ]);

        DB::table('users')->insert([
            'username' => 'medio',
            'password' => bcrypt('medio'),
            'tipo' => 'medio'
        ]);

        DB::table('users')->insert([
            'username' => 'pc1',
            'password' => bcrypt('pc1'),
            'tipo' => 'normal'
        ]);

        DB::table('users')->insert([
            'username' => 'pc2',
            'password' => bcrypt('pc1'),
            'tipo' => 'normal'
        ]);

        DB::table('users')->insert([
            'username' => 'pc3',
            'password' => bcrypt('pc3'),
            'tipo' => 'normal'
        ]);

    }
}