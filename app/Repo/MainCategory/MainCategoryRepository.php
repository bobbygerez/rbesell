<?php namespace App\Repo\MainCategory;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\MainCategory;


class MainCategoryRepository extends BaseRepository implements MainCategoryInterface{


	protected $optimus;

	public function __construct(){

		$this->modelName = new MainCategory();

		
	}

	public function optimusEncode($value){

		return $optimus->encode($value);
	}
	
}