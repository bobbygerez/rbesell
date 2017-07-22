<?php

use Illuminate\Database\Seeder;
use App\Trade;

class TradeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $faker = Faker\Factory::create();

        for ($i=1; $i < 30; $i++) { 
        	Trade::create([

        		'created_by' => rand(1, 30),
        		'name' => $faker->company,
        		'desc' => $faker->sentence($nbWords = 6, $variableNbWords = true)

        	]);
        }
        
    }
}
