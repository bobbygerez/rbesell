<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\User\UserInterface;
use App\Repo\Role\RoleInterface;
use App\Repo\MaritalStatus\MaritalStatusInterface;
use Auth;

class AreaManagerUserController extends Controller
{
    

	public function __construct(UserInterface $user, RoleInterface $role, MaritalStatusInterface $maritalStatus){

    	$this->user = $user;
    	$this->role = $role;
        $this->maritalStatus = $maritalStatus;
    }


     public function index(){

        $request = app()->make('request');
        
        $users = $this->user->getAllUsers($request);

        $roles = $this->user->heirarchyroles();
        
        return response()->json([
                'users' => $users,
                'roles' => $roles
            ]);
     }

     public function edit($id){

    	$user = $this->user->whereNoDecode('id', Auth::User()->id)
    		->with(['roles', 'personalData', 'contactData'])
    		->first();

    	$heirarchy = $user->roles->min()->heirarchy;

    	 $roles = $this->role->roles()->get();

        
    	return response()->json([

    			'user' => $user,
    			'chunkRoles' => $roles->chunk(3),
                'maritalStatus' => $this->maritalStatus->all(),
                'heirarchy' => $heirarchy,
    			'success' => true

    		]);
    }

    public function update($id){

       $request = app()->make('request');

       $this->user->update($request, $id);

       return response()->json([

            'success' => true,
            'message' => 'You have successfully update your account.'
        ]);

    }
}
