<?php namespace App\Repo\MaritalStatus;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\MaritalStatus;

class MaritalStatusRepository extends BaseRepository implements MaritalStatusInterface{

	public function __construct(){

		$this->modelName = new MaritalStatus();
	}

	
}