<?php

namespace App\Http\Controllers\Quantity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Product\ProductInterface;
use App\Repo\Quantity\QuantityInterface;

class AreaManagerQuantityController extends Controller
{
    	
    protected $product;
    protected $quantity;

    public function __construct(ProductInterface $product, QuantityInterface $quantity){

    	$this->product = $product;
    	$this->quantity = $quantity;

    }

    public function store(){

    	$request = app()->make('request');

    	$this->product->newQuantity( $request );

    	
    }

    public function destroy($id){

    	$this->quantity->findNoDecode($id)->delete();

    	
    }
}
