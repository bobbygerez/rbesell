<?php

namespace App\Http\Controllers\Quantity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Controller\ResourceController;
use Auth;

class QuantityController extends Controller
{
    
    use ResourceController;
    
     public function __construct(){

        $this->middleware('auth');

        $this->middleware(function($request, $next){

            $this->controllerName =  'App\Http\Controllers\Quantity'. '\\'. Auth::User()->role(). 'QuantityController';

            return $next($request);
        });
      }
   
}
