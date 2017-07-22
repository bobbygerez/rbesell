<?php

use Illuminate\Database\Seeder;
use App\Productable;

class ProductablesTableSeeder extends Seeder
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

            
             $productable = Productable::create([

                    'user_id' => rand(1, 30),
                    'productable_id' => rand(1, 200),
                    'productable_type' => $productableType[rand(0, 1)],
                    'discount_id' => rand(1, 200),
                    'price' => $faker->randomFloat(2, $min = 5, $max = 30000),
                    'quantity_id' => rand(1, 400)

                ]);

             $productable->products()->attach($productable->id, [

                    'product_id' => rand(1, 200),
                    'productable_id' => $productable->id
                ]);

        }

        
    }
}
