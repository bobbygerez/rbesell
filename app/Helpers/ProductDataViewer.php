<?php 

namespace App\Helpers;

trait ProductDataViewer {


	public function scopeProductsViewer($query){
		
		return $query->with(['photos', 'unit'])->paginate(10);
	}
}