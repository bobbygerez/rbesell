<?php

namespace App\Http\Controllers\Discount;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Discount\DiscountInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class SystemAdminDiscountController extends Controller
{

	protected $discount;

	public function __construct(DiscountInterface $discount){

		$this->discount = $discount;
	}	
    

    public function edit($id){

    	return response()->json([

    			'discount' => $this->discount->findNoDecode($id)
    		]);
    }

    public function store(){

    	$request = app()->make('request');
    	$this->discount->store($request);
    }


}
