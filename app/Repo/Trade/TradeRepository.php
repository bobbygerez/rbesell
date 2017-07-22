<?php namespace App\Repo\Trade;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Trade;

class TradeRepository extends BaseRepository implements TradeInterface{

	public function __construct(){

		$this->modelName = new Trade();
	}

	
}