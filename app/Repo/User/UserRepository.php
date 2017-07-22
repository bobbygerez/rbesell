<?php namespace App\Repo\User;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\User;

class UserRepository extends BaseRepository implements UserInterface{

	public function __construct(){

		$this->modelName = new User();
	}

	
	public function update($request, $id){

		$roles = $request->input('roles');

		$user = $this->modelName->find($id);

		$user->update($request->all());

		$user->roles()->sync($roles);
        
        $user->personalData->update( $request->all() );

        $user->contactData->update( $request->all() );

	}

	 public function orWhereHas($model, $string){

        return $this->modelName->orWhereHas($model, function($query) use ($string) {

                $query->where('lastname', 'LIKE', '%'.$string.'%')
                    ->orWhere('firstname', 'LIKE', '%'.$string.'%');

            })
            ->orWhere('email', 'LIKE', '%'.$string.'%');
    }
	
}