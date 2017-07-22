<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminProductController extends Controller
{
    public function __construct(){

    	$this->middleware('auth');
    }
    public function index(){

    }
}
