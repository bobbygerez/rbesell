<?php

use Illuminate\Database\Seeder;
use App\Franchise;

class FranchiseTableSeeder extends Seeder
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
        	Franchise::create([

        		'created_by' => rand(1, 30),
        		'trade_id' => $i,
        		'merchant_id' => rand(1, 30)

        	]);
        }
        
    }
}
