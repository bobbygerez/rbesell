<?php

namespace App\Http\Controllers\OwnershipType;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\OwnershipType\OwnershipTypeInterface;

class OwnershipTypeController extends Controller
{
    
    protected $ownershipType;

	public function __construct(OwnershipTypeInterface $ownershipType){

		$this->ownershipType = $ownershipType;
	}

    public function index(){

    	return response()->json([

    			'ownershipType' => $this->ownershipType->all()
    		]);
    }
}
