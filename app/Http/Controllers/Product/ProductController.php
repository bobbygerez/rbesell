<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Controller\ResourceController;
use Auth;

class ProductController extends Controller
{

	use ResourceController;


    public function __construct(){

    	$this->middleware('auth');

		$this->middleware(function($request, $next){

			$this->controllerName =  'App\Http\Controllers\Product'. '\\'. Auth::User()->role(). 'ProductController';

			return $next($request);
		});

    }
    
	
	public function productSearch(){

		return app($this->controllerName)->productSearch();
	}

	
}
