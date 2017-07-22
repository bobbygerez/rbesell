<?php namespace App\Repo\City;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\City;

class CityRepository extends BaseRepository implements CityInterface{

	public function __construct(){

		$this->modelName = new City();
	}

	
	
}