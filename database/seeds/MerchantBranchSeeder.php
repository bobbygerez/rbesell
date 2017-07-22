<?php

use Illuminate\Database\Seeder;
use App\Merchant;

class MerchantBranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	for ($i=1; $i < 30; $i++) { 
    		
    		$merchant = Merchant::find($i);

    		$merchant->branches()->attach($i, [
    				'merchant_id' => $i,
    				'branch_id' => rand(1, 30)
    			]);

    	}
        
    }
}
