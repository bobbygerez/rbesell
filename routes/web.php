<?php


// Route::resource('tasks', 'TaskController');

/******************* AJAX ROUTES ******************/

Route::group(['prefix' => 'api'], function(){

	Route::post('photo/product/upload', 'Photo\PhotoController@photoProduct');
	Route::resource('role', 'Role\AdminRoleController');

	Route::resource('cities', 'City\CityController');
	Route::resource('provinces', 'Province\ProvinceController');
	Route::resource('regions', 'Region\RegionController');
	Route::resource('countries', 'Country\CountryController');


	Route::post('register-user-merchant', 'Auth\RegisterController@userMerchant');

	Route::post('email/unique', 'Auth\RegisterController@emailUnique');



	Route::resource('ownership_type', 'OwnershipType\OwnershipTypeController');
	Route::resource('registered_by', 'RegisteredBy\RegisteredByController');

	Route::resource('franchise', 'Franchise\FranchiseController');

	Route::post('trade-check-unique-name', 'Trade\TradeController@checkUnique');



	//User Controller
	Route::post('user-contact-info-update', 'User\UserController@contactInfoUpdate');
	Route::post('user-personal-data-update', 'User\UserController@perDataUpdate');
	Route::post('user-basic-info-update', 'User\UserController@basicInfoUpdate');
	Route::post('user-my-profile', 'User\UserController@myProfile');
	Route::post('user-add-position', 'User\UserController@addPosition');
	Route::post('user-remove-position', 'User\UserController@removePosition');
	Route::get('user-pop', 'User\UserController@userPopUp');
	Route::get('user-search', 'User\UserController@search');
	Route::resource('user', 'User\UserController');


	//Products Controller
	Route::post('product-search', 'Product\ProductController@productSearch');
	Route::resource('product', 'Product\ProductController');

	//Branches Controller
	Route::post('branch-contact-info-update', 'Branch\BranchController@contactInfoUpdate');
	Route::post('branch-get-images-dz', 'Branch\BranchController@getImagesDZ');
	Route::post('branch-remove-photos', 'Branch\BranchController@removePhotos');
	Route::post('branch-upload-photos', 'Branch\BranchController@uploadPhotos');
	Route::post('branch-company-info-update', 'Branch\BranchController@companyInfoUpdate');
	Route::post('branch-search', 'Branch\BranchController@branchSearch');
	Route::resource('branches', 'Branch\BranchController');



	//Merchant Controller
	Route::post('merchant-get-images-dz', 'Merchant\MerchantController@getImagesDZ');
	Route::post('merchant-remove-photos', 'Merchant\MerchantController@removePhotos');
	Route::post('merchant-upload-photos', 'Merchant\MerchantController@uploadPhotos');
	Route::post('merchant-contact-info', 'Merchant\MerchantController@contactInfo');
	Route::post('merchant-franchisor','Merchant\MerchantController@franchisor');
	Route::post('merchants-search', 'Merchant\MerchantController@autoCompleteMerchant');
	Route::get('merchant-search', 'Merchant\MerchantController@search');
	Route::post('merchant-branches', 'Merchant\MerchantController@branches');
	Route::resource('merchant', 'Merchant\MerchantController');



	Route::resource('price', 'Price\PriceController');
	Route::resource('quantity', 'Quantity\QuantityController');

	Route::post('position/add_access', 'Position\PositionController@addAccess');
	Route::post('position/remove_role', 'Position\PositionController@removeRole');
	Route::resource('position', 'Position\PositionController');

	Route::resource('main_functions', 'MainFunction\MainFunctionController');
	Route::resource('policy', 'Policy\PolicyController');
	
	/** Categories **/
	Route::get('maincategories/{maincategory_id}', 'AjaxCategoriesController@mainCategories');
	Route::get('merchant-categories/{merchantcategory_id}', 'AjaxCategoriesController@merchantCategories');
	Route::get('merchant-subcategories/{merchantsubcategory_id}', 'AjaxCategoriesController@merchantSubcategories');
	Route::get('sample', 'AjaxCategoriesController@getData');

	Route::resource('maincategory', 'MainCategory\MainCategoryController');
	/** Products **/
	Route::get('products', 'Product\ApiProductController@getData');

});

/******************* END AJAX ROUTES ******************/


/****************** IMPLICIT ROUTES *****************/
Route::get('logout', 'Auth\LoginController@logout');
Route::auth();
Route::get('/', ['route' => 'home', 'uses' => 'NavController@home']);

Route::get('dashboard', 'DashboardController@index');
Route::get('dashboard/{user_id}', 'DashboardController@userId');


/******************  END IMPLICIT ROUTES *****************/


/****************** END ROUTE PREFIX ***************/

Route::post('api/authenticated', function(){

	  if(Auth::check()){

            return response()->json([

                    'user' => Auth::User()->personalData->firstname . ' ' . Auth::User()->personalData->lastname,
                    'id' => Obfuscate::encode(Auth::User()->id),
                    'authenticated' => true

                ]);
        }

        return response()->json([
                'authenticated' => false
            ]);
});