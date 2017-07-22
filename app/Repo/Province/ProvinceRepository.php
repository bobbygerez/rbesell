<?php 

namespace App\Repo\Province;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Province;

class ProvinceRepository extends BaseRepository implements ProvinceInterface{

	public function __construct(){

		$this->modelName = new Province();
	}

	
}