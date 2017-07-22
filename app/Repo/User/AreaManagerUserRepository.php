<?php namespace App\Repo\User;

use App\Repo\User\UserRepository;
use App\Repo\BaseInterface;
use App\User;
use App\Role;
use Auth;

class AreaManagerUserRepository extends UserRepository implements UserInterface{

	

	public function __construct(){

		$this->modelName = new User();
	}

	 public function getAllUsers($request) {

        $users = '';
        $roleId = $request->roleId;
        $string = $request->string;

        if($roleId !=''){

           return $this->roleId($roleId, $string, $roles);
        }
       

        if($request->string != ''){

            $string = $request->string;

            $users = $this->orWhereHas('personalData', $string)
            ->with(['personalData'])
            ->get();

        }

        else{

           
            $users = $this->with(['roles', 'personalData'])->get();
            $users =  $users->sortBy('lastname')->values()->all();
        }

        return $users;

    }

	
	public function roleId($roleId, $string) {

		$users = '';

		if($string == ''){

                $users = $this->modelName->with(['roles', 'personalData', 'contactData'])->get();
        }
        else{

             $users = $this->orWhereHas('personalData', $string)
                 ->with(['roles', 'personalData', 'contactData'])
                 ->get();
        }
            
            
        $users =  $users->filter(function($user) use ($roleId, $string){
            
            foreach ($user->roles as $role) {
                
                if ($role->id == $roleId) {
                    
                    
                    return $user;
                }
            }
        });


       
	}

   


    public function heirarchyRoles(){

    	$user = $this->whereNoDecode('id', Auth::User()->id)
    		->with(['roles', 'personalData', 'contactData'])
    		->first();

    	$heirarchy = $user->roles->min()->heirarchy;

    	return Role::where('heirarchy', '>', $heirarchy)->get();

    }

    public function getBranches($merchants){

    	$branches = [];

    	foreach ($merchants as $merchant) {
    		
    		foreach ($merchant->branches as $branch) {
    			
    			$branches[] =  $branch;
    		}
    	}

    	return collect($branches)->unique('id');

    }


    public function getBranchUsers($branches){

    	$users = [];

    	foreach ($branches as $branch) {
    		
    		foreach ($branch->users as $user) {
    			
    			$users[] = $user;
    		}
    	}

    	return collect($users)->unique('id');
    

    }


}