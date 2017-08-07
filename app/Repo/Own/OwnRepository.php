<?php 

namespace App\Repo\Own;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Own;

class OwnRepository extends BaseRepository implements OwnInterface{

	public function __construct(){

		$this->modelName = new Own();
	}

	
}