<?php

namespace App\Http\Controllers\User;

use App\Traits\Controller\ResourceController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\User;

class UserController extends Controller
{

    use ResourceController;
    
    protected $controllerName;
    
    public function __construct(User $user){

        $this->user = $user;

        $this->middleware('auth');

        $this->middleware(function($request, $next){

            $this->controllerName = 'App\Http\Controllers\User'. '\\'. Auth::User()->role() . 'UserController';

            return $next($request);
        });

    }


    public function update($id){

        return app($this->controllerName)->update($id);
    }


    public function userPopUp(){


        return app($this->controllerName)->userPopUp();

    }

    public function myProfile(){

         return app($this->controllerName)->myProfile();
    }

    public function search(){
         
         return app($this->controllerName)->search();
    }

    public function removePosition(){

       return app($this->controllerName)->removePosition();
    }

     public function addPosition(){

       return app($this->controllerName)->addPosition();
    }

    

}
