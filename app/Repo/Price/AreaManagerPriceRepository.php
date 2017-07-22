<?php namespace App\Repo\Price;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Price;

class AreaManagerPriceRepository extends BaseRepository implements PriceInterface{

	public function __construct(){

		$this->modelName = new Price();
	}

	
}