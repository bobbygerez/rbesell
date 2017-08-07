<?php

namespace App\Http\Controllers\MerchantCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Controller\ResourceController;
use Auth;

class MerchantCategoryController extends Controller
{
    use ResourceController;


    protected $controllerName;
    
    public function __construct(){

		$this->middleware(function($request, $next){

			if(Auth::check()){

				$this->controllerName = 'App\Http\Controllers\MerchantCategory'. '\\'. Auth::User()->role() . 'MerchantCategoryController';

				return $next($request);
			}else{

				$this->controllerName = 'App\Http\Controllers\MerchantCategory\UserMerchantCategoryController';

				return $next($request);
			}

			
		});

    }

    public function mainCategoriesSelected(){

    	 return app($this->controllerName)->mainCategoriesSelected();
    }
}
