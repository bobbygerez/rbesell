<?php namespace App\Repo\MerchantSubcategory;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\MerchantSubcategory;


class MerchantSubcategoryRepository extends BaseRepository implements MerchantSubcategoryInterface{


	protected $optimus;

	public function __construct(){

		$this->modelName = new MerchantSubcategory();

		
	}

	
}