<?php

namespace App\Http\Controllers\MainCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\MainCategory\MainCategoryInterface;

class UserMainCategoryController extends Controller
{
    
    protected $mainCategory;

	public function __construct(MainCategoryInterface $mainCategory){

		$this->mainCategory = $mainCategory;
	}

    public function index(){

    	$mainCategories = $this->mainCategory->orderBy('name', 'ASC')->get();

    	return response()->json([

    			'mainCategories' => $mainCategories
    		]);
    }
}
