<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

use Faker\Factory as Faker;

class cliSeeder extends Seeder
{
    public function run()
    {
    	$faker = Faker::create('es_ES');

    	foreach (range(1,1000) as $index) {
	        DB::table('clientes')->insert([
	            'apecli' => $faker->lastName.' '.$faker->lastName,
	            'nomcli' => $faker->firstName,
	            'dni' => $faker->numberBetween($min = 10000000, $max = 99999999),
	            'fenac' => $faker->date,
	            'direc' => $faker->address,
	            'pobla' => $faker->city
	        ]);
        }
    }
}