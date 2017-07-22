<?php

namespace App\Http\Controllers\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Branch\BranchInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class SystemAdminBranchController extends Controller
{
    
    protected $branch;

    public function __construct(BranchInterface $branch){

    	$this->branch = $branch;

    }

    public function index(){

    	$request = app()->make('request');

    	$branches  = $this->branch
    				->with(['merchant'])
    				->orderBy('created_at', 'desc')
    				->get();


        $paginate = new LengthAwarePaginator($branches->forPage($request->page, $request->per_page), $branches->count(), $request->per_page, $request->page);

        return response()->json([

                'branches' => $paginate

            ]);
    }

    public function show($id){

        $request = app()->make('request');
        $branches = $this->branch->whereNoDecode('id', $id)
                        ->with(['merchant'])
                        ->get();

        $paginate = new LengthAwarePaginator($branches->forPage($request->page, $request->per_page), $branches->count(), $request->per_page, $request->page);

        return response()->json([

                'branches' => $paginate

            ]);
    }

    public function edit($id){

        $branch = $this->branch->whereNoDecode('id', $id)
                    ->with(['merchant', 'address.country', 'address.province', 'address.city'])
                    ->first();

        return response()->json([

                'branch' => $branch

            ]);
    }


    public function branchSearch(){

        $request = app()->make('request');

        $branches = $this->branch
                        ->whereOperator('branch_name', 'LIKE', '%'.$request->q.'%')
                        ->get();

        return response()->json([
                'branches' => $branches
            ]);

    }

    public function companyInfoUpdate(){

        $request = app()->make('request');
        $branch = $this->branch->findNoDecode($request->id);
        $branch->update($request->all());

        $branch = $this->branch->whereNoDecode('id', $request->id)
                     ->with(['merchant', 'address.country', 'address.province', 'address.city'])
                    ->first();

        return response()->json([

                'branch' => $branch,
                'success' => true,
                'message' => $branch->branch_name . 'has been successfully updated.'

            ]);
        
    }

    public function contactInfoUpdate(){

        $request = app()->make('request');
        $branch = $this->branch->findNoDecode($request->id);
        $branch->update($request->all());

        $this->branch->contactInfoUpdate($request);

        $branch = $this->branch->whereNoDecode('id', $request->id)
                    ->with(['merchant', 'address.country', 'address.province', 'address.city'])
                    ->first();

        return response()->json([

                'branch' => $branch,
                'success' => true,
                'message' => $branch->branch_name . 'has been successfully updated.'

            ]);
        
    }


    public function uploadPhotos(){

        $request = app()->make('request');

        $result = $this->branch->photoUpload($request);

        return response()->json([

                'message' => $result,
                'success' => true

            ]);
    }

    public function removePhotos(){

        $request = app()->make('request');

        $result = $this->branch->removePhotos($request);

        return response()->json([

                'success' => true

            ]);

    }

    public function getImagesDZ(){

        $request = app()->make('request');

        return response()->json([

                'images' => $this->branch->getImagesDZ($request, $request->desc)
            ]);
    }

    
}
