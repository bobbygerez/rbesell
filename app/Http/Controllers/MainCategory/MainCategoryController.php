<?php

namespace App\Http\Controllers\MainCategory;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Controller\ResourceController;
use Auth;

class MainCategoryController extends Controller
{
    use ResourceController;


    protected $controllerName;
    
    public function __construct(){

		$this->middleware(function($request, $next){


			if(Auth::check()){

				$this->controllerName = 'App\Http\Controllers\MainCategory'. '\\'. Auth::User()->role() . 'MainCategoryController';

				return $next($request);
			}else{

				$this->controllerName = 'App\Http\Controllers\MainCategory\UserMainCategoryController';

				return $next($request);
			}

			
		});

    }
}
