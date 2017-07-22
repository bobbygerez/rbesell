<?php namespace App\Repo;

interface BaseInterface {

	public function all();
	public function store( $request );
	public function find($id);
	public function where($fieldName, $id);
	public function with($array);
}