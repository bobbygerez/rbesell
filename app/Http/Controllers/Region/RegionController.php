<?php

namespace App\Http\Controllers\Region;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Region\RegionInterface;

class RegionController extends Controller
{
    
    protected $region;
    
    public function __construct(RegionInterface $region){

    	$this->region = $region;
    }

    public function index(){

    	$request = app()->make('request');

    	return response()->json([

    			'regions' => $this->region->all()
    		]);
    }
}
