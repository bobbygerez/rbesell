<?php

namespace App\Http\Controllers\Category;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Controller\ResourceController;
use Auth;

class CategoryController extends Controller
{

	use ResourceController;

    protected $controllerName;
    
    public function __construct(){

    	$this->middleware('auth');

		$this->middleware(function($request, $next){

			$this->controllerName = 'App\Http\Controllers\Branch'. '\\'. Auth::User()->role() . 'BranchController';

			return $next($request);
		});

    }

    public function index(){

    	dd('asdf');
    }
}
