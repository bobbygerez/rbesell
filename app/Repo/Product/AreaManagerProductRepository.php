<?php 

namespace App\Repo\Product;

use App\Repo\BaseRepository;
use App\Repo\BaseInterface;
use App\Product;

class AreaManagerProductRepository extends BaseRepository implements ProductInterface{

	public function __construct(){

		$this->modelName = new Product();
		
	}


    public function destroy($id){

        $product = $this->modelName->find($id);
        $product->branches()->detach();
        $product->prices()->delete();
        $product->quantities()->delete();
        $product->delete();
    }

	public function newQuantity( $request ){

		$product = $this->modelName->find($request->productId);

		$product->quantities()->create([

				'product_id' => $request->productId,
				'qty' => $request->quantity

			]);
	}

	 public function branchName($user, $branchName){

        $products = [];

        foreach ($user->branches()->where('branch_name', 'LIKE', '%' . $branchName . '%')->get() as $branch) {
            
            $branchName = $branch->branch_name;

            foreach ($branch->products as $product) {
                
                $price = '';

                foreach ($product->prices as $price) {
                    
                    $price = $price->isPrimary($product->id);
                }

                $products[] = [ 

                        'id' => $product->id, 
                        'branch' => $branchName,
                        'name' => $product->name,
                        'price' => $price,
                        'discount2' => $product->discount2,
                        'quantities' => $product->quantities,
                        'date' => $product->created_at
                    ];
            }
        }


        return $products;
    }

    public function productName($user, $productName){

        $products = [];

        foreach ($user->branches as $branch) {
            
            $branchName = $branch->branch_name;

            foreach ($branch->products()->where('name', 'LIKE', '%' . $productName . '%')->get() as $product) {
                
                $price = '';

                foreach ($product->prices as $price) {
                    
                    $price = $price->isPrimary($product->id);
                }

                $products[] = [ 

                        'id' => $product->id, 
                        'branch' => $branchName,
                        'name' => $product->name,
                        'price' => $price,
                        'discount2' => $product->discount2,
                        'quantities' => $product->quantities,
                        'date' => $product->created_at
                    ];
            }
        }


        return $products;
        
    }

    public function branchProductName($user, $branchName, $productName){

        $products = [];

        foreach ($user->branches()->where('branch_name', 'LIKE', '%' . $branchName . '%')->get() as $branch) {
            
            $branchName = $branch->branch_name;

            foreach ($branch->products()->where('name', 'LIKE', '%' . $productName . '%')->get() as $product) {
                
                $price = '';

                foreach ($product->prices as $price) {
                    
                    $price = $price->isPrimary($product->id);
                }

                $products[] = [ 

                        'id' => $product->id, 
                        'branch' => $branchName,
                        'name' => $product->name,
                        'price' => $price,
                        'discount2' => $product->discount2,
                        'quantities' => $product->quantities,
                        'date' => $product->created_at
                    ];
            }
        }


        return $products;
    }
    public function products($user){

        $products = [];

        foreach ($user->branches as $branch) {
            
            $branchName = $branch->branch_name;

            foreach ($branch->products as $product) {
                
                $price = '';

                foreach ($product->prices as $price) {
                    
                     $price = $price->isPrimary($product->id);
                    


                }


                $products[] = [ 

                        'id' => $product->id, 
                        'branch' => $branchName,
                        'name' => $product->name,
                        'price' => $price,
                        'discount2' => $product->discount2,
                        'quantities' => $product->quantities,
                        'date' => $product->created_at
                    ];
            }
        }

        return $products;
    }

    public function filterResult($request, $user){

        $products = '';

        if( $request->branchName != ''){

            if ($request->productName != '') {
            
                 $products = $this->branchProductName($user, $request->branchName, $request->productName);
            }
            else {

                $products = $this->branchName($user, $request->branchName);
            }

            
        }

        
        else {

            if ($request->productName != '') {
            
                 $products = $this->productName($user, $request->productName);
            }
            else {

                $products = $this->products($user);
            }
            
        }

        return $products;
    }

	
	
}