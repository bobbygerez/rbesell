<?php 

namespace App\Repo\RegisteredBy;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\RegisteredBy;

class RegisteredByRepository extends BaseRepository implements RegisteredByInterface{

	public function __construct(){

		$this->modelName = new RegisteredBy();
	}

	
}