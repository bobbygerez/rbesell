<?php 

namespace App\Repo;

use Obfuscate;
use File;

class BaseRepository{

	protected $modelName;

	public function all(){

		return $this->modelName->all();
	}

	public function store( $request ){

		return $this->modelName->create($request->all());

	}

	
	public function find( $id ){

		$origId = Obfuscate::decode($id);
		return $this->modelName->find($origId);
	}

	public function findNoDecode($id){

		return $this->modelName->find($id);
	}

	public function update($request, $id){

		return $this->modelName->find($id)->update($request->all());
	}

	public function destroy($id){

		return $this->modelName->find($id)->delete();
	}
	public function where($fieldName, $id){

		$origId = Obfuscate::decode($id);
		return $this->modelName->where($fieldName, $origId);
	}

	public function whereIn($fieldName, $array){

		return $this->modelName->whereIn($fieldName, $array);
	}

	public function whereNoDecode($fieldName, $id){

		return $this->modelName->where($fieldName, $id);
	}

	public function whereOperator($fieldName, $operator, $value){

		return $this->modelName->where($fieldName, $operator, $value);
	}

	public function with($array){

		return $this->modelName->with($array);
	}

	public function searchPaginateAndOrder(){

		return $this->modelName->searchPaginateAndOrder();
	}

	public function orderBy($fieldName, $sort){

		return $this->modelName->orderBy($fieldName, $sort);
	}

	public function orWhere($fieldName, $operator, $value){

		return $this->modelName->orWhere($fieldName, $operator, $value);
	}
	
	public function whereHas($model, $fieldName, $operator, $value){

		return $this->modelName->whereHas($model, function($query) use ($fieldName, $operator, $value){

				$query->where($fieldName, $operator, $value);
		});
	}
	
	public function first( $model ){

		$result = $model->first();
		if($result){

			return $result;
		}

		return [];
	}

	public function contactInfoUpdate( $request ){

		$model = $this->findNoDecode($request->id);

		if($model->address){	

			if ($request->address != null){


				$model->address()->update($request->address);
			}

			
		}
		else {
			
			if ($request->address != null){


				$model->address()->create($request->address);
			}
		}
	}
	public function photoUpload( $request ){

		$requestAll = $request->all();

		$file = $request->file;

		$destinationPath = 'images/uploads/';
		// Get the orginal filname or create the filename of your choice
		$filename =  str_random(10) . '-' . $file->getClientOriginalName();
		// Copy the file in our upload folder
		$file->move($destinationPath, $filename );

		$model = $this->findNoDecode($request->id);

		$requestAll['name'] = $file->getClientOriginalName();
		$requestAll['path'] = $destinationPath.$filename;

		$model->photos()->create($requestAll);
		
		return 'You have successfully uploaded the image';
	}

	public function removePhotos($request){

		$model = $this->findNoDecode($request->id);

		$photos = $model->photos()->where('name', $request->name)
						->where('desc', $request->desc)
						->get();

		foreach ($photos as $photo) {
			
			File::delete($photo->path);
		}

		$model->photos()->where('name', $request->name)
						->where('desc', $request->desc)
						->delete();

	}
	
	public function getImagesDZ($request, $desc){

		
		$merchant = $this->findNoDecode($request->id);

		return $merchant->photos()
					->where('desc', $desc)
					->get();

	}
}