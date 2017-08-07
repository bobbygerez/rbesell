<?php 

namespace App\Repo\Unit;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Unit;

class UnitRepository extends BaseRepository implements UnitInterface{

	public function __construct(){

		$this->modelName = new Unit();
	}

	
}