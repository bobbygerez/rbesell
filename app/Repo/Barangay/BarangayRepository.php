<?php namespace App\Repo\Barangay;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\ModelLocations\Barangay;

class BarangayRepository extends BaseRepository implements BarangayInterface{

	public function __construct(){

		$this->modelName = new Barangay();
	}

	
	
}