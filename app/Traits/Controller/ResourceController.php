<?php 

namespace App\Traits\Controller;

trait ResourceController {

	public function index(){
		 return app($this->controllerName)->index();
	}

	public function show($id){

		return app($this->controllerName)->show($id);
	}

	public function edit($id){

		return app($this->controllerName)->edit($id);
	}

	
	public function destroy($id){

		return app($this->controllerName)->destroy($id);
	}

	

}