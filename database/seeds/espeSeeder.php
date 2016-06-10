<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class espeSeeder extends Seeder
{

    public function run()
    {
        DB::table('especiali')->insert([
            'nomesp' => 'ninguna'
        ]);
    }

}
