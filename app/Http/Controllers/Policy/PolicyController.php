<?php

namespace App\Http\Controllers\Policy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Policy\PolicyInterface;
use Auth;

class PolicyController extends Controller
{

	protected $policy;

    public function __construct(PolicyInterface $policy){

    	$this->middleware('auth');
    	$this->policy = $policy;

    }

    public function index(){

        $request = app()->make('request');

        $users = $this->policy->getUsers($request);

    	return response()->json([  


                'success' => true,
                'policies' => $this->policy->all(),
    			'user_policies' => $users

    		]);
    }

    public function store(){

        $request = app()->make('request');

        $policy = $this->policy->store($request);

        return response()->json([

                'message' => 'You have successfully updated the Access Right!'
            ]);
    }
}
