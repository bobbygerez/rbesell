<?php 

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class PositionsFacade extends Facade {

	protected static function getFacadeAccessor() {

		return 'positionsfacade';
	}

}