<?php 

namespace App\Repo\Brand;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Brand;

class BrandRepository extends BaseRepository implements BrandInterface{

	public function __construct(){

		$this->modelName = new Brand();
	}

	
}