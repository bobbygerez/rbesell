<?php

namespace App\Http\Controllers\Branch;

use App\Http\Requests\Branch\BranchCompanyInfoRequest;
use App\Traits\Controller\ResourceController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class BranchController extends Controller
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

    public function branchSearch(){

    	return app($this->controllerName)
		 	->branchSearch();
    }


    public function companyInfoUpdate(BranchCompanyInfoRequest $request){

        return app($this->controllerName)
            ->companyInfoUpdate();
    }

    public function contactInfoUpdate(){

        return app($this->controllerName)
            ->contactInfoUpdate();
    }

    public function uploadPhotos(){
        return app($this->controllerName)
            ->uploadPhotos();
    }

    public function removePhotos(){

        return app($this->controllerName)
            ->removePhotos();
    }

    public function getImagesDZ(){

        return app($this->controllerName)
            ->getImagesDZ();
    }

    
}
