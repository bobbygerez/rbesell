<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\User\UserInterface;
use App\Repo\Position\PositionInterface;
use App\Repo\City\CityInterface;
use App\Repo\MaritalStatus\MaritalStatusInterface;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;

class SystemAdminUserController extends Controller
{
    protected $user;
    protected $position;
    protected $maritalStatus;
    protected $city;

    public function __construct(UserInterface $user, PositionInterface $position, MaritalStatusInterface $maritalStatus, CityInterface $city){

    	$this->middleware('auth');
    	$this->middleware('role:System Admin');
    	$this->user = $user;
        $this->position = $position;
        $this->maritalStatus =$maritalStatus;
        $this->city = $city;
    }

    public function index(){

       

        $request = app()->make('request');
        
        $users = $this->user
                ->with(['positions', 'personalData', 'contactData'])
                ->orderBy('created_at', 'asc')
                ->get();

        $paginate = new LengthAwarePaginator($users->forPage($request->page, $request->per_page), $users->count(), $request->per_page, $request->page);

        return response()->json([
                'users' => $paginate
            ]);
    }


    public function edit($id){


        $positions = $this->position->orderBy('created_at', 'asc')->get();

        $maritalStatus = $this->maritalStatus->orderBy('name', 'asc')->get();

        $user = $this->user->whereNoDecode('id', $id)
            ->with(['positions', 'personalData', 'contactData'])
            ->first();

        return response()->json([

                'user' => $user,
                'maritalStatus' => $maritalStatus,
                'positions' => $positions,
                'success' => true,

            ]);
    }

    public function update($id){

        $request = app()->make('request');
        
        $user = $this->user->update($request, $id);

        return response()->json([

                'message' => 'The User has been successfully updated!',
                'success' => true

            ]);
        
    }

    public function destroy($id){

        $this->user->findNoDecode($id)->delete();

        return response()->json([

                'message' => 'The User has been Deleted!'

            ]);
    }

    public function userPopUp(){

        $request = app()->make('request');

        $users = $this->user->orWhereHas('personalData', $request->q)
            ->with(['personalData'])
            ->take(8)
            ->get();

        $data = $users->map( function($item){

                return [
                    'id' => $item->id,
                    'user' => $item->personalData->firstname . ' ' . $item->personalData->lastname . ' (' . $item->email . ')',
                    'email' => $item->email,
                    'firstname' => $item->personalData->firstname,
                    'lastname' => $item->personalData->lastname

                ];
        });

        
        return response()->json(

                $data
            );
    }

    public function myProfile(){
         $positions = $this->position->orderBy('created_at', 'asc')->get();

        $maritalStatus = $this->maritalStatus->orderBy('name', 'asc')->get();

        $user = $this->user->whereNoDecode('id', Auth::User()->id)
            ->with(['positions', 'personalData', 'contactData'])
            ->first();

        return response()->json([

                'user' => $user,
                'maritalStatus' => $maritalStatus,
                'positions' => $positions,
                'success' => true,

            ]);
    }

    public function search(){

        $request = app()->make('request');

        $users = $this->user
                ->whereNoDecode('id', $request->id)
                ->with(['positions', 'personalData', 'contactData'])
                ->get();

        $paginate = new LengthAwarePaginator($users->forPage($request->page, $request->per_page), $users->count(), $request->per_page, $request->page);

        return response()->json([
                'users' => $paginate
            ]);

    }

    public function removePosition(){

        $request = app()->make('request');

        $user = $this->user->findNoDecode($request->id);
        $user->positions()->detach($request->positionIds);

          return response()->json([

                'message' => 'The position has been successfully removed!',
                'success' => true

            ]);
        
    }

    public function addPosition(){

        $request = app()->make('request');

        $user = $this->user->findNoDecode($request->id);
        $user->positions()->attach($request->positionIds);

          return response()->json([

                'message' => 'The position has been successfully added!',
                'success' => true

            ]);
    }
}
