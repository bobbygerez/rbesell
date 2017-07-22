<?php

namespace App\Policies;
use App\Task;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TaskPolicy
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

    public function index(User $user, Task $task){

        dd($user->id . 'create');
    }
    public function update(User $user, Task $task){

        dd($user->id);
         return $user->id === $task->user_id;

    }
}
