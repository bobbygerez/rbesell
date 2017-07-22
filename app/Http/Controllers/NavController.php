<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repo\MainCategory\MainCategoryInterface;
use App\Repo\MerchantCategory\MerchantCategoryInterface;
use App\Repo\MerchantSubcategory\MerchantSubcategoryInterface;
use Obfuscate;

class NavController extends Controller
{

	protected $mainCategory;
    protected $merchantCategory;
    protected $merchantSubcategory;

	public function __construct(MainCategoryInterface $mainCategory, MerchantCategoryInterface $merchantCategory, MerchantSubcategoryInterface $merchantSubcategory){

		$this->mainCategory = $mainCategory;
        $this->merchantCategory = $merchantCategory;
        $this->merchantSubcategory = $merchantSubcategory;
	}
    
    public function home(){

    	$mainCategories = $this->mainCategory->with(['merchantCategory', 'merchantCategory.merchantSubcategory'])->get();
    	
    	return view('templates.template3.index', compact('mainCategories'));
    }

    public function mainCategories($maincategoryName, $maincategoryId){
    	
        $menuCategories = $this->mainCategory->with(['merchantCategory', 'merchantCategory.merchantSubcategory'])->get();

 
        $result = $this->mainCategory->where('id', $maincategoryId)->with(['merchantCategory','merchantCategory.merchantSubcategory.products']);
        $mainCategories = $this->mainCategory->first($result);
        

     
        return view('templates.template3.products.main-products', compact('mainCategories', 'menuCategories'));
    }

    public function merchantCategories($maincategoryName, $merchantCategoryName, $merchantCategoryId){

        $menuCategories = $this->mainCategory->with(['merchantCategory', 'merchantCategory.merchantSubcategory'])->get();

    	$result = $this->merchantCategory->where('id', $merchantCategoryId)->with(['mainCategory', 'merchantSubcategory','merchantSubcategory.products' ]);

        $merchantCategories = $this->merchantCategory->first($result);
          
        return view('templates.template3.products.merchant-category-products', compact('merchantCategories', 'menuCategories', 'maincategoryName'));
    }

    public function merchantSubcategories($maincategoryName, $merchantCategoryName, $merchantSubName, $merchantSubNameId){

        $menuCategories = $this->mainCategory->with(['merchantCategory', 'merchantCategory.merchantSubcategory'])->get();

        $result = $this->merchantSubcategory->where('id', $merchantSubNameId)->with(['products', 'merchantCategory.mainCategory', 'merchantCategory']);

        $merchantSubcategories = $this->merchantCategory->first($result);
        
        return view('templates.template3.products.merchant-subcategory-products', compact('merchantSubcategories', 'menuCategories'));
    }

    public function sample(){

        return view('templates.template3.sample');
    }
}
