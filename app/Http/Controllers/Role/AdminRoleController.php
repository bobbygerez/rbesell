<?php

namespace App\Http\Controllers\Role;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Role\RoleInterface;

class AdminRoleController extends Controller
{

	protected $role;
    
    public function __construct(RoleInterface $role){

    	$this->middleware('auth');
    	$this->middleware('role:System Admin');
    	$this->role = $role;

    }

    public function index(){

    	return response()->json([

    			'roles' => $this->role->with(['accessRights'])->get()
    		]);
    }
}
