<?php namespace App\Repo\Role;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Role;
use Auth;

class AreaManagerRoleRepository extends BaseRepository implements RoleInterface{

	public function __construct(){

		$this->modelName = new Role();
	}

	public function roles(){

		$minRole = Auth::User()->roles->min();

		return $this->modelName->where('heirarchy', '>=', $minRole->heirarchy);
			
		
	}
	
}