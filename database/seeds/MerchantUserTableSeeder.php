<?php

use Illuminate\Database\Seeder;
use App\Merchant;

class MerchantUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	for ($i=1; $i < 200; $i++) { 
    		 $merchant = Merchant::find(rand(1,30));
        	$merchant->users()->attach([
        		'merchant_id' => rand(1, 30),
        		'user_id' => rand(1, 30)
        	]);
    	}
        
       
    }
}
