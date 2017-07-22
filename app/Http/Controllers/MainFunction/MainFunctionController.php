<?php

namespace App\Http\Controllers\MainFunction;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\MainFunction\MainFunctionInterface;

class MainFunctionController extends Controller
{
    
    protected $mainFunction;

    public function __construct(MainFunctionInterface $mainFunction){

    	$this->middleware('auth');
    	$this->mainFunction = $mainFunction;


    }

    public function index(){


    	return response()->json([

    			'mainFunctions' => $this->mainFunction->with(['subFunctions'])->get(),
    			'success' => true

    		]);

    }
}
