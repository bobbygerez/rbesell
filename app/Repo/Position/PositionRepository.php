<?php namespace App\Repo\Position;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Position;

class PositionRepository extends BaseRepository implements PositionInterface{

	public function __construct(){

		$this->modelName = new Position();
	}

	public function destroy($id){

		$position = $this->modelName->find($id);
		$position->roles()->detach();
		$position->delete();
	}


	
	
}