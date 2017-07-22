<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\User\UserInterface;
use App\Repo\Branch\BranchInterface;
use App\Repo\Unit\UnitInterface;
use Illuminate\Pagination\LengthAwarePaginator;

use Auth;

class AreaManagerProductController extends Controller
{
    
    protected $user;
    protected $branch;
    protected $unit;
    
    public function __construct(UserInterface $user, BranchInterface $branch, ProductInterface $product, UnitInterface $unit){


        $this->middleware('auth');
        $this->middleware('role:Area Manager');

    	$this->user = $user;
        $this->branch = $branch;
        $this->product = $product;
        $this->unit = $unit;

       


    }

    public function index(){
       
        $request = app()->make('request');
       
        $user = $this->user->whereNoDecode('id', Auth::User()->id)
            ->with(['branches.products.prices', 'branches.products.quantities'])
            ->first();

        $products = $this->product->filterResult($request, $user);
      
        $per_page = 40;

        $collection = collect($products);


        $paginate = new LengthAwarePaginator($collection->forPage($request->current_page, $per_page), $collection->count(), $per_page, $request->current_page, ['path'=>url('api/products')]);


    	return response()->json([

                'branches' => $this->branch->all(),
                'products' => $paginate,
                'success' => true

            ]);
    }

   
    public function edit($id){

        $product = $this->product->whereNoDecode('id', $id)
            ->with(['prices', 'quantities', 'photos', 'user.personalData', 'branches'])
            ->first();
        
        return response()
            ->json([

                    'product' => $product,
                    'units' => $this->unit->all()
                ]);

    }

    public function update($id){

        $request = app()->make('request');


        $product = $this->product->update($request, $id);
       

        return response()->json([

                'message' => 'You have successfully updated this product.',
                'success' => true
            ]);
    }

    public function destroy($id){

        $this->product->destroy($id);

        return response()->json([

                'message' => 'You have successfully deleted the product.',
                'success' => true
            ]);
    }


}
