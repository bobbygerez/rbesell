<?php

use Illuminate\Database\Seeder;
use App\Discount;
use Carbon\Carbon;

class DiscountTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productableType = ['App\Merchant', 'App\Branch'];
        $faker = Faker\Factory::create();
        
        for ($i= 1; $i < 200; $i++) { 

            
            $randomInt = rand(1, 30);
            $newType = $productableType[rand(0,1)];

             $discount = Discount::create([
                    'created_by' => rand(1, 30),
                    'discountable_id' => $randomInt,
                    'discountable_type' => $newType,
                    'name' => $faker->text($maxNbChars = 20),
                    'percent' => rand(1, 99),
                    'desc' => $faker->text($maxNbChars = 20),
                    'start' => Carbon::now(),
                    'end' => Carbon::tomorrow()
                ]);


        }
    }
}
