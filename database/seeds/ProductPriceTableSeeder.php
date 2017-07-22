<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductPriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$faker = Faker\Factory::create();

        for ($i=1; $i < 300; $i++) { 
        	
        	$product = Product::find(rand(1, 200));
        	$product->prices()->create([

        			'product_id' => $product->id,
        			'price' => $faker->randomFloat(2, $min = 5, $max = 30000),
                    'is_primary' => rand(0, 1)
        		]);
        }
    }
}
