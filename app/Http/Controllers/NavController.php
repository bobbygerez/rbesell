<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Obfuscate;

class NavController extends Controller
{

    public function home(){
    	
    	return view('templates.material-design.index');
    }

   
}
