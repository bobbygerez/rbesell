<?php

use Illuminate\Database\Seeder;
use App\Merchant;

class BranchMerchantTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        
        for ($i=0; $i < 200 ; $i++) { 
        	
        	$merchant = Merchant::find(rand(1, 30));
        	$merchant->branches()->attach([

        			'user_id' => rand(1, 30),
        			'merchant_id' => rand(1, 30)
        			
        		]);
        }
    }
}
