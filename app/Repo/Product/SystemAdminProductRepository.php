<?php 

namespace App\Repo\Product;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Product;

class SystemAdminProductRepository extends BaseRepository implements ProductInterface{

	public function __construct(){

		$this->modelName = new Product();
		
	}


}


?>