<?php

namespace App\Http\Controllers\Quantity;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Quantity\QuantityInterface;


class SystemAdminQuantityController extends Controller
{

	protected $quantity;

	public function __construct(QuantityInterface $quantity){

		$this->quantity = $quantity;
	}

    public function show($id){

    	return response()->json([
    			'qty' => $this->quantity->findNoDecode($id)->qty
    		]);
    }

}
