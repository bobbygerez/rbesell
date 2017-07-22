<?php namespace App\Repo\MerchantCategory;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\MerchantCategory;


class MerchantCategoryRepository extends BaseRepository implements MerchantCategoryInterface{



	public function __construct(){

		$this->modelName = new MerchantCategory();

		
	}

	
}