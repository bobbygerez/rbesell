<?php

namespace App\Http\Controllers\Price;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Price\PriceInterface;
use App\Repo\Product\ProductInterface;


class AreaManagerPriceController extends Controller
{
    
    protected $price;
    protected $product;
    
    public function __construct(PriceInterface $price, ProductInterface $product){

		$this->price = $price;
		$this->product = $product;

	}

	public function update($id){

		$request = app()->make('request');
      
        $product = $this->product->findNoDecode($id);
        $product->prices()->update([
                'is_primary' => 0
            ]);
        
        $product->prices()->create([
                'product_id' => $id,
                'price' => $request->price,
                'is_primary' => 1,
            ]);
	}

	public function destroy($id){

		$price = $this->price->findNoDecode($id);

		$price->delete();
	}

}
