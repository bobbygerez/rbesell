<?php

namespace App\Http\Controllers\Trade;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Trade\TradeNameFormRequest;
class TradeController extends Controller
{
   	
   	public function checkUnique(TradeNameFormRequest $request){
   		
   		return response()->json([

   				'success' => true
   			]);
   	}
}
