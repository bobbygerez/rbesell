<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\Quantity;

class ProductQuantityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=1; $i < 400; $i++) { 
        	
        	$product = Product::find(rand(1, 200));

            $quantitable = ['App\Merchant', 'App\Branch'];
            
        	Quantity::create([

        			'product_id' => rand(1, 200),
        			'qty' => rand(1, 30),
                    'quantitable_id' => rand(1, 30),
                    'quantitable_type' => $quantitable[rand(0, 1)]

        		]);
        }
    }
}
