<?php

use Illuminate\Database\Seeder;
use App\Merchant;
use App\Photo;

class MerchantAttachmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

    	for ($i=1; $i < 60; $i++) { 
    		
    		$merchant = Merchant::find($i);
        
	        $photo = new Photo();
	        $photo->path =  'images/uploads/art-' . rand(1, 7)  . '.jpg';
	        $photo->name = 'Article of Corporation';
	        $photo->desc = 'Article of Corporation';
	        $merchant->photos()->save($photo);

    	}
        
        for ($i=1; $i < 60; $i++) { 
    		
    		$merchant = Merchant::find($i);
        
	        $photo = new Photo();
	        $photo->path =  'images/uploads/bir-' . rand(1, 7) . '.jpg';
	        $photo->name = 'BIR Certification';
	        $photo->desc = 'BIR Certification';
	        $merchant->photos()->save($photo);

    	}

    	for ($i=1; $i < 60; $i++) { 
    		
    		$merchant = Merchant::find($i);
        
	        $photo = new Photo();
	        $photo->path =  'images/uploads/sec-' . rand(1, 7)  . '.jpg';
	        $photo->name = 'SEC';
	        $photo->desc = 'SEC';
	        $merchant->photos()->save($photo);

    	}

    	for ($i=1; $i < 60; $i++) { 
    		
    		$merchant = Merchant::find($i);
        
	        $photo = new Photo();
	        $photo->path =  'images/uploads/logo-' . rand(1, 7) . '.jpg';
	        $photo->name = 'LOGO';
	        $photo->desc = 'LOGO';
	        $merchant->photos()->save($photo);

    	}

    	for ($i=1; $i < 60; $i++) { 
    		
    		$merchant = Merchant::find($i);
        
	        $photo = new Photo();
	        $photo->path =  'images/uploads/permit-' . rand(1, 7) . '.jpg';
	        $photo->name = 'Business Permit';
	        $photo->desc = 'Business Permit';
	        $merchant->photos()->save($photo);

    	}


    }
}
