<?php

namespace App\Http\Controllers\Merchant;

use Illuminate\Http\Request;
use App\Http\Requests\MerchantFormRequest;
use App\Http\Controllers\Controller;
use Auth;

class MerchantController extends Controller
{
    
    protected $role;

	public function __construct(){

		$this->middleware('auth');

		$this->middleware(function($request, $next){

			$this->role =  Auth::User()->role();

			return $next($request);
		});
	}

	public function index(){

		 return app('App\Http\Controllers\Merchant'. '\\'. $this->role. 'MerchantController')
		 	->index();
	}

	public function edit($id){

		return app('App\Http\Controllers\Merchant'. '\\'. $this->role. 'MerchantController')
			->edit($id);
	}

	public function update(MerchantFormRequest $request, $id){
		return app('App\Http\Controllers\Merchant'. '\\'. $this->role. 'MerchantController')
			->update($request, $id);
	}

	public function branches(){
		return app('App\Http\Controllers\Merchant'. '\\'. $this->role. 'MerchantController')
			->branches();
	}

	public function search(){
		return app('App\Http\Controllers\Merchant'. '\\'. $this->role. 'MerchantController')
			->search();
	}

	public function autoCompleteMerchant(){

		return app('App\Http\Controllers\Merchant'. '\\'. $this->role. 'MerchantController')
			->autoCompleteMerchant();
	}

	public function franchisor(){

		return app('App\Http\Controllers\Merchant'. '\\'. $this->role. 'MerchantController')
			->franchisor();
	}

	public function contactInfo(){
		return app('App\Http\Controllers\Merchant'. '\\'. $this->role. 'MerchantController')
			->contactInfo();
	}

	public function uploadPhotos(){

		return app('App\Http\Controllers\Merchant'. '\\'. $this->role. 'MerchantController')
			->uploadPhotos();
	}

	public function removePhotos(){

		return app('App\Http\Controllers\Merchant'. '\\'. $this->role. 'MerchantController')
			->removePhotos();
	}


	public function getImagesDZ(){

		return app('App\Http\Controllers\Merchant'. '\\'. $this->role. 'MerchantController')
			->getImagesDZ();
	}
}
