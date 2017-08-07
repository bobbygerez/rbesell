<?php

namespace App\Http\Controllers\Discount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Controller\ResourceController;
use Auth;

class DiscountController extends Controller
{
    use ResourceController;


    protected $controllerName;
    
    public function __construct(){

    	$this->middleware('auth');

		$this->middleware(function($request, $next){

			$this->controllerName = 'App\Http\Controllers\Discount'. '\\'. Auth::User()->role() . 'DiscountController';

			return $next($request);
		});

    }
    public function store(){

		return app($this->controllerName)->store();
	}
}
