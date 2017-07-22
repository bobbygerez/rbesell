<?php

namespace App\Helpers;

use Auth;

class PositionsHelper {



	public function systemAdmin(){

		if (Auth::User()->role()){

			return true;
		}

		return false;
	}
}