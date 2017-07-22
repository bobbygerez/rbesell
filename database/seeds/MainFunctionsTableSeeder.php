<?php

use Illuminate\Database\Seeder;
use App\MainFunction;
use App\SubFunction;
use App\DeepSubFunction;

class MainFunctionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	DB::statement('SET FOREIGN_KEY_CHECKS=0;');
    		MainFunction::truncate();
    		SubFunction::truncate();
    	DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        
        $mainFunctions = [

        	'My Profile',
        	'My Beneficiary / Receiver',
        	'My Order',
        	'My Wishlist',
        	'My Payment Methods',
        	'My Account',
        	'Change Password',
        	'Merchant',
        	'Branch',
        	'Users',
        	'Inventory management',
        	'Settlement Management',
        	'Advertisement',
        	'Settings',
        	'POS',
        	'Orders',
        	'Payment Methods',
        	'Coupon Management',
        	'Voucher Management',
        	'Reward Points Management',
        	'Logistics / Delivery Management',
        	'Dashboard and Reports per user',
        	'Utilities'
        ];

        $myAccount = [
        	'My Reward Points',
        	'My Card / wallet'
        ];

        $merchant = [

        	'Applicant',
        	'Processing /Validation',
        	'Approved',
        	'Merchant Category',
            'Bronse', 'Silver', 'Gold'
        ];


        $inventoryMgt = [

        	'Product',
        	'Price',
        	'Inventory count',
        	'Categories',
        	'Featured Product',
        	'Hot Deals',
        	'Special Offer',
        	'On Sale',
        	'Brand',
        	'Batch upload inventory',
        	'Units Setup',
        	'Current Vs. Previous month sales',
        	'Periodic Sales',
        	'Float amount',
        	'Aging',
        	'VAT (Vatable Goods and Items)'

        ];

        $settleMgt = [

        	'Settlement Terms / Merchant',
        	'Settlement Account / Merchant',
        	'Merchant Discount Rate / merchant',
        	'Revenue Sharing Scheme'

        ];

        $settings = [

        	'FAQ',
        	'Terms and Conditions',
        	'Company Profile and About us'
        ];

        $logisticsMgt = [

        	'Individual Accreditation',
        	'Company'

        ];

        $dashBoardReportUser = [

        	'Daily Sales',
        	'Weekly Sales',
        	'Monthly sales',
        	'Contact us',
        	'Customer Service',
        	'Blogspot',
        	'Shopping Guide'
        ];



        foreach ($mainFunctions as $mainfunction) {
        	
        	$newMainFunction = MainFunction::create([

        			'name' => $mainfunction

        		]);


        	if($mainfunction == 'My Account'){

        		foreach($myAccount as $myAcct){

        			SubFunction::create([

        				'main_function_id' => $newMainFunction->id,
        				'name' => $myAcct
        			]);

        		}

        		
        	}

        	if($mainfunction == 'Merchant'){

        		foreach($merchant as $me){

        			$subFunction = SubFunction::create([

        				'main_function_id' => $newMainFunction->id,
        				'name' => $me
        			]);

        		}
        	}

        	if( $mainfunction == 'Inventory management'){

        		foreach($inventoryMgt as $me){

        			SubFunction::create([

        				'main_function_id' => $newMainFunction->id,
        				'name' => $me
        			]);

        		}
        	}

        	if( $mainfunction== 'Settlement Management'){

        		foreach($settleMgt as $me){

        			SubFunction::create([

        				'main_function_id' => $newMainFunction->id,
        				'name' => $me
        			]);

        		}
        	}

        	if( $mainfunction == 'Settings'){

        		foreach($settings as $me){

        			SubFunction::create([

        				'main_function_id' => $newMainFunction->id,
        				'name' => $me
        			]);

        		}
        	}

        	if( $mainfunction == 'Logistics / Delivery Management'){

        		foreach($logisticsMgt as $me){

        			SubFunction::create([

        				'main_function_id' => $newMainFunction->id,
        				'name' => $me
        			]);

        		}
        	}

        	if( $mainfunction == 'Dashboard and Reports per user'){

        		foreach($dashBoardReportUser as $me){

        			SubFunction::create([

        				'main_function_id' => $newMainFunction->id,
        				'name' => $me
        			]);

        		}
        	}
        }
    }
}
