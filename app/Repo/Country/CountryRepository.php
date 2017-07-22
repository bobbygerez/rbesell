<?php namespace App\Repo\Country;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Country;

class CountryRepository extends BaseRepository implements CountryInterface{

	public function __construct(){

		$this->modelName = new Country();
	}

	
}