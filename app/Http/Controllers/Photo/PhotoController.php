<?php

namespace App\Http\Controllers\Photo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PhotoController extends Controller
{
    
    public function photoProduct(){

    	$request = app()->make('request');

    	dd($request->all());
    }
}
