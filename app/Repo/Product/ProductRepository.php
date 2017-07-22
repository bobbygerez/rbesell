<?php namespace App\Repo\Product;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Product;

class ProductRepository extends BaseRepository implements ProductInterface{

	public static $columns = [
        'id', 'model_number', 'name', 'unit_id', 'desc', 'discount', 'photo'
    ];

	public function __construct(){

		$this->modelName = new Product();
		
	}

	
	public function searchPaginateAndOrder(){

		return $this->modelName->searchPaginateAndOrder();
	}
}