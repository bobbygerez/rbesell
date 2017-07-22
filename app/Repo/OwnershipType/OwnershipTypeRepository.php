<?php 

namespace App\Repo\OwnershipType;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\OwnershipType;

class OwnershipTypeRepository extends BaseRepository implements OwnershipTypeInterface{

	public function __construct(){

		$this->modelName = new OwnershipType();
	}

	
}