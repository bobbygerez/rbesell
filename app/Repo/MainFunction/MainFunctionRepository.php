<?php 

namespace App\Repo\MainFunction;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\MainFunction;

class MainFunctionRepository extends BaseRepository implements MainFunctionInterface{

	public function __construct(){

		$this->modelName = new MainFunction();
	}

	
}