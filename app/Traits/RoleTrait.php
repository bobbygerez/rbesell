<?php 

namespace App\Traits;
use Auth;

trait RoleTrait{

	public function role(){


         $positions = Auth::User()->positions;

            $roles = $positions->map(function($position){

                return $position->roles->map(function($role){

                    return $role;
                });
            });

          return   $this->role = str_replace(' ', '', $roles[0]->min()->name);
    }
}