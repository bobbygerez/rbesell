<?php

namespace App\Http\Controllers\Position;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Position\PositionInterface;
use App\Repo\Role\RoleInterface;

class PositionController extends Controller
{
    
    protected $position;
    protected $role;

    public function __construct(PositionInterface $position, RoleInterface $role){

    	$this->position = $position;
        $this->role = $role;

    }

    public function index(){

    	return response()->json([

    			'positions' => $this->position->all(),
    			'success' => true

    		]);
    }

    public function create(){

         $roles = $this->role->orderBy('heirarchy', 'asc')
            ->select(['id', 'name'])
            ->get();

        return response()->json([

                'roles' => $roles,
                'success' => true

            ]);

    }

    public function store(){

        $request = app()->make('request');

        $roles = collect($request->roles)->map(function($item, $key){

            return $item['id'];
        });

        $position = $this->position->store($request);
        $position = $this->position->findNoDecode($position->id);
        $position->roles()->attach($roles);

       return response()->json([

            'message' => 'You have successfully created the position.',
            'success' => true
        ]);

    }

    public function edit($id){

        $position = $this->position->whereNoDecode('id', $id)
            ->with(['roles'])
            ->first();

        $currentRoles = $position->roles->unique(function($item){

            return $item->name;
        });

        $roles = $this->role->orderBy('heirarchy', 'asc')
            ->select(['id', 'name'])
            ->get();


        return response()->json([

                'currentRoles' => $currentRoles,
                'position' => $position,
                'success' => true,
                'roles' => $roles
            ]);
    }

    public function update($id){

        $request =  app()->make('request');
        $position = $this->position->update($request, $id);

       return response()->json([

                'message' => 'You have successfully updated the position.',
                'success' => true
            ]);

    }

    public function destroy($id){

        $this->position->destroy($id);

        return response()->json([

                'message' => 'You have successfully deleted the position.',
                'success' => true
            ]);
    }

    public function removeRole(){

        $request = app()->make('request');

        $position = $this->position->findNoDecode($request->positionId);

        $position->roles()->detach($request->removeRoleId);

        return response()->json([

                'message' => 'You have successfully removed the access right.',
                'success' => true
            ]);


    }

    public function addAccess(){

         $request = app()->make('request');


        $position = $this->position->findNoDecode($request->positionId);

        $position->roles()->attach($request->addAccess);

        return response()->json([

                'message' => 'You have successfully added an access right.',
                'success' => true
            ]);
    }
}
