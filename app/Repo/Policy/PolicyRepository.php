<?php namespace App\Repo\Policy;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Policy;
use App\User;

class PolicyRepository extends BaseRepository implements PolicyInterface{

	public function __construct(){

		$this->modelName = new Policy();
	}

	public function getUsers($request){


		$policy  = $this->findNoDecode(1);

        $users = $policy->users()
                    ->newPivotStatement()
                    ->where('user_id', $request->id)
                    ->select('policy_id')
                    ->get();

        

        return $users->map(function($item){

            return $item->policy_id;
        });
	}

	public function store($request){

		$policy  = $this->findNoDecode(1);
		$policy->users()
			->newPivotStatement()
			->where('user_id', $request->userId)
			->delete();

		foreach ($request->userPolicies as $value) {
			
			$user = User::find($request->userId);

			$user->policies()->attach($request->userId, [
					'policy_id' => $value,
					'policeable_id' => $request->userId,
					'policeable_type' => 'App\User',
					'user_id' => $request->userId
				]);
		}
	}

	
}