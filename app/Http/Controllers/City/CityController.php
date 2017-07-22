<?php

namespace App\Http\Controllers\City;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\City\CityInterface;

class CityController extends Controller
{
    
    protected $city;

    public function __construct(CityInterface $city){

    	$this->city = $city;
    }

    public function index(){

    	$request = app()->make('request');

    	return response()->json([

    			'cities' => $this->city->whereNoDecode('state_id', $request->province_id)->get()
    		]);
    }
}
