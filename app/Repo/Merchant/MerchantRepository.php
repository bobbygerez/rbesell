<?php namespace App\Repo\Merchant;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Merchant;

class MerchantRepository extends BaseRepository implements MerchantInterface{

	public function __construct(){

		$this->modelName = new Merchant();
	}

	
}