<?php

namespace App\Http\Controllers\Country;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Country\CountryInterface;

class CountryController extends Controller
{
    
    protected $country;

    public function __construct(CountryInterface $country){

    	$this->country = $country;
    }

    public function index(){

    	return response()->json([

    			'countries' => $this->country->all()
    		]);
    }
}
