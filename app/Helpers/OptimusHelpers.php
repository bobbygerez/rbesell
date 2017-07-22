<?php 

namespace App\Helpers;
use Jenssegers\Optimus\Optimus;

class OptimusHelpers {

	public function __construct(){

		$this->optimus = new Optimus(1580030173, 59260789, 1163945518);
	}

	public function encode( $value){

		return $this->optimus->encode( $value );
	}

	public function decode($value ){

		return $this->optimus->decode( $value );
	}
}