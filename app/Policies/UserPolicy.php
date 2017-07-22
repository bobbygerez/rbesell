<?php

namespace App\Policies;
use Auth;
use App\User;
use App\Policy;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index(User $user){

        $policies = Policy::find(1);

        $policies = $policies->users()
            ->newPivotStatement()
            ->where('user_id', Auth::User()->id)
            ->get();

        foreach($policies as $policy){

            if($policy->policy_id === 1){

                return true;
            }
        }

    }
}
