<?php

namespace App\Http\Controllers\Product;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repo\Product\ProductInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class SystemAdminProductController extends Controller
{
    
    protected $product;

    public function __construct(ProductInterface $product){

        $this->product = $product;

    }

    public function index(){

    	$request = app()->make('request');

        $products = $this->product
                    ->with(['user','owns.user', 'owns.discounts', 'owns.quantities', 'productable', 'owns.ownable'])
                    ->get();

    	$paginate = new LengthAwarePaginator($products->forPage($request->page, $request->per_page), $products->count(), $request->per_page, $request->page);

    	return response()->json([

    			'products' => $paginate

    		]);

    }

    public function show($id){

       
    }

    public function edit($id){

         $request = app()->make('request');

        $products = $this->product->whereNoDecode('id', $id)
                        ->with([
                            'user','owns.user', 'owns.discounts', 
                            'owns.quantities', 'productable', 'owns.ownable', 'owns.brand'
                            ])
                        ->first();

        $productables = $products->owns;

        $paginate = new LengthAwarePaginator($productables->forPage(1, 10), $productables->count(), 10, 1);


        return response()->json([

                'productables' => $paginate

            ]);
       
    }

    public function productSearch(){

         $request = app()->make('request');

        $products = $this->product
                        ->whereOperator('name', 'LIKE', '%'.$request->q.'%')
                        ->take(10)
                        ->get();

        return response()->json([
                'products' => $products
            ]);
    }
}
