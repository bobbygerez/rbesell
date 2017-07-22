<?php 

namespace App\Repo\Discount;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Discount;

class DiscountRepository extends BaseRepository implements DiscountInterface{

	public function __construct(){

		$this->modelName = new Discount();
	}

	
}