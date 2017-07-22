<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Obfuscate;

class DashboardController extends Controller
{

	protected $user;

    public function __construct(){

    	$this->middleware('auth');
    }


    public function index(){

    	return redirect()->to('dashboard/' . Obfuscate::encode(Auth::User()->id) );
    }

    public function userId(){

    	return view('templates.template3.dashboard.index');
    }
}
