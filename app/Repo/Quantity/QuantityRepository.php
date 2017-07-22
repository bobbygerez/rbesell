<?php namespace App\Repo\Quantity;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Quantity;

class QuantityRepository extends BaseRepository implements QuantityInterface{

	public function __construct(){

		$this->modelName = new Quantity();
	}


	public function newQuantity( $request ){

		
	}
	
}