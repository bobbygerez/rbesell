<?php

namespace App\Http\Controllers\Quantity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Quantity\QuantityInterface;
use App\Repo\Own\OwnInterface;


class SystemAdminQuantityController extends Controller
{

	protected $quantity;
	protected $own;

	public function __construct(QuantityInterface $quantity, OwnInterface $own){

		$this->quantity = $quantity;
		$this->own = $own;
	}

    public function edit($id){

    	return response()->json([
    			'quantity' => $this->quantity
							->whereNoDecode('id', $id)
							->with(['quantitable'])
							->first()
    		]);
    }

    public function update($id){

    	$request = app()->make('request');

    	$this->quantity->update($request, $id);

    	$productable = $this->own->whereNoDecode('id', $request->productable_id)
    		->with(['ownable', 'user', 'discounts', 'quantities', 'brand'])
    		->first();

    	return response()->json([

    			'message' => 'You have successfully updated the quantity.',
    			'productable' => $productable
    		]);
    }

    public function store(){

        $request = app()->make('request');

        $this->quantity->store($request);
    }

}
