<?php

namespace App\Http\Controllers\RegisteredBy;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\RegisteredBy\RegisteredByInterface;
class RegisteredByController extends Controller
{

	protected $registeredBy;
   	
   	 public function __construct(RegisteredByInterface $registeredBy){

   	 	$this->registeredBy = $registeredBy;
   	 }

   	 public function index(){

   	 	return response()->json([
   	 			'registeredBy' => $this->registeredBy->all()
   	 		]);
   	 }
}
