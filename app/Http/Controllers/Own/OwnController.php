<?php

namespace App\Http\Controllers\Own;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Controller\ResourceController;
use Auth;

class OwnController extends Controller
{
    
    use ResourceController;


    public function __construct(){

    	$this->middleware('auth');

		$this->middleware(function($request, $next){

			$this->controllerName =  'App\Http\Controllers\Own'. '\\'. Auth::User()->role(). 'OwnController';

			return $next($request);
		});

    }

    
}
