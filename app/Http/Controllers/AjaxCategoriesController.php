<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repo\MainCategory\MainCategoryInterface;
use App\Repo\MerchantCategory\MerchantCategoryInterface;
use App\Repo\MerchantSubcategory\MerchantSubcategoryInterface;
use App\MainCategory;

class AjaxCategoriesController extends Controller
{
    
    protected $mainCategory;
    protected $merchantCategory;
    protected $merchantSubcategory;

	public function __construct(MainCategoryInterface $mainCategory, MerchantCategoryInterface $merchantCategory, MerchantSubcategoryInterface $merchantSubcategory){

		$this->mainCategory = $mainCategory;
        $this->merchantCategory = $merchantCategory;
        $this->merchantSubcategory = $merchantSubcategory;
	}

	public function mainCategories($mainCategoryId){
    	
    	$mainCategories = $this->mainCategory->where('id', $mainCategoryId)->with(['merchantCategory', 'merchantCategory.merchantSubcategory', 'products'])->get();

        dd($mainCategories);
    	return response()->json([

    			'maincategories' => $mainCategories
	   		]);
    }

    public function merchantCategories($merchantCategoryId){

    	$merchantCategories = $this->merchantCategory->where('id', $merchantCategoryId)->with(['merchantSubcategory', 'products'])->get();
        
        return response()->json([

    			'merchantCategories' => $merchantCategories
	   		]);
    }

    public function merchantSubcategories($merchantSubcategoryId){


        $merchantSubcategories = $this->merchantSubcategory->where('id', $merchantSubcategoryId)->with('products')->get();
        
        return response()->json([

        		'merchantSubcategories' => $merchantSubcategories

        	]);
    }

    public function getData(){

        $model = MainCategory::searchPaginateAndOrder();
        $columns = MainCategory::$columns;

        return response()->json([
                'model' => $model,
                'columns' => $columns
            ]);
    }
}
