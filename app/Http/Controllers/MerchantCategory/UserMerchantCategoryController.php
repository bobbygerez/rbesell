<?php

namespace App\Http\Controllers\MerchantCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\MerchantCategory\MerchantCategoryInterface;
use App\Repo\MainCategory\MainCategoryInterface;

class UserMerchantCategoryController extends Controller
{
    
    protected $mainCategory;
    protected $merchantCategory;

	public function __construct(MainCategoryInterface $mainCategory, MerchantCategoryInterface $merchantCategory){

        $this->mainCategory = $mainCategory;
        $this->merchantCategory = $merchantCategory;

	}

    public function mainCategoriesSelected(){

       $request = app()->make('request');

       $mainCategories = $this->mainCategory->whereIn('id', array_values($request->selectedMainCat))
                                ->with(['merchantCategory'])
                                ->get();

        $merchantCategories = $mainCategories->map(function( $mainCategory, $index){

            return $mainCategory->merchantCategory;
            
        })->flatMap(function($values){

            return $values;
        });

       return response()->json([
            'merchantCategories' => $merchantCategories->all()
        ]);
    }
}
