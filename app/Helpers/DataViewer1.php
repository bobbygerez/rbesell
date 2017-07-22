<?php 

namespace App\Helpers;
use Validator;

trait DataViewer1{


	
	public function scopeSearchPaginateAndOrder($query){

		$request = app()->make('request');

		$v = Validator::make($request->only([
				'column', 'direction', 'per_page'
			]), [
			'column' => 'required|alpha_dash|in:'. implode(',', self::$columns) ,
			'direction' => 'required|in:asc,desc',
			'per_page' => 'integer|min:1'

		]);

		if($v->fails()){

			dd($v->messages());
		}

		return $query->orderBy($request->column, $request->direction)->paginate($request->per_page);

	}
}