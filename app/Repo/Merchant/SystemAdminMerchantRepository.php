<?php namespace App\Repo\Merchant;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Merchant;
use Auth;
use File;

class SystemAdminMerchantRepository extends BaseRepository implements MerchantInterface{

	public function __construct(){

		$this->modelName = new Merchant();
	}

	public function updateMerchant($request){

		$merchant = $this->findNoDecode($request->id);

		$requestAll = $request->all();

		if($requestAll['for_franchise'] == 1){

			$franchisor = [];
			$franchisor['created_by'] = Auth::User()->id;
			$franchisor['name'] = $requestAll['franchisor_name'];

				if($merchant->trade != null){
					
					$merchant->trade()->update($franchisor);
					$requestAll['trade_id'] = $merchant->trade->id;

				}
				else {

					dd('null');
					$merchant->trade()->create($franchisor);

				}


			$requestAll['franchise_id'] = null;
		}
		else {
			$franchisee = [];
			$franchisee['trade_id'] = $requestAll['franchisee'];
			$franchisee['created_by'] = Auth::User()->id;
			$franchisee['merchant_id'] = $request->id;

			if($merchant->franchisee != null ){

				$merchant->franchisee()->update($franchisee);
				$requestAll['franchise_id'] = $merchant->franchisee->id;

			}
			else{

				$franchise = $merchant->franchisee()->create($franchisee);
				$requestAll['franchise_id'] = $franchise->id;
			}

			$requestAll['trade_id'] = null;
		


		}
		
        $merchant->update($requestAll);

        return $this->whereNoDecode('id', $request->id)
            ->with(['branches','photos', 'trade', 'address.country', 'address.province', 'address.city', 'franchisee'])
            ->first();
	}

	public function contactInfo($request){

		$merchant = $this->findNoDecode($request->id);
		$request = collect($request->all());

		$merchant->update($request['companyInfo']);

        if ( count($merchant->address) > 0) {

            $merchant->address()->update($request['contactInfo']);

        }

        else {

            $merchant->address()->create($request['contactInfo']);

        }

         return $merchant->name . ' address has been successfully updated.';
	}

	public function photoUpload( $request ){

		$requestAll = $request->all();

		$file = $request->file;

		$destinationPath = 'images/uploads/';
		// Get the orginal filname or create the filename of your choice
		$filename =  str_random(10) . '-' . $file->getClientOriginalName();
		// Copy the file in our upload folder
		$file->move($destinationPath, $filename );

		$merchant = $this->findNoDecode($request->merchant_id);

		$requestAll['name'] = $file->getClientOriginalName();
		$requestAll['path'] = $destinationPath.$filename;

		$merchant->photos()->create($requestAll);
		
		return 'You have successfully uploaded the image';
	}

	public function removePhotos($request){

		$merchant = $this->findNoDecode($request->merchant_id);

		$photos = $merchant->photos()->where('name', $request->name)
						->where('desc', $request->desc)
						->get();

		foreach ($photos as $photo) {
			
			File::delete($photo->path);
		}

		$merchant->photos()->where('name', $request->name)
						->where('desc', $request->desc)
						->delete();

	}

	public function getImagesDZ($request, $desc){


		$merchant = $this->findNoDecode($request->merchant_id);

		return $merchant->photos()
					->where('desc', $desc)
					->get();

	}

	
}