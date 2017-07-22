<?php

namespace App\Http\Controllers\Price;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class PriceController extends Controller
{

	protected $price;

    
    public function update($id){

    	app('App\Http\Controllers\Price\AreaManagerPriceController')->update($id);

    	 return response()->json([

                'message' => 'You have successfully added a price.',
                'success' => true
            ]);
    }

    public function destroy($id){

    	app('App\Http\Controllers\Price\AreaManagerPriceController')->destroy($id);

    	return response()->json([
    			'message' => 'You have successfully deleted the price.',
    			'success' => true
    		]);
    }
}
