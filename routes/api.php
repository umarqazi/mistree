<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::group(['prefix'=>'customer'], function() {
	Route::post('register', 'CustomersController@register');
	Route::post('login', 'CustomersController@login');
	Route::post('recover', 'CustomersController@recover');    
});
Route::group(['middleware' => 'conf_guard:Customer'], function(){
	Route::group(['prefix'=>'customer','middleware' => ['jwt.auth']], function() {  
		Route::post('logout', 'CustomersController@logout');
		Route::post('regStoreData', 'CustomersController@regStoreData');
		Route::post('verify-email', 'CustomersController@verifyEmail');
		
		Route::get('get-cars', 'CarsController@index');
		Route::post('add-customer-car', 'CarsController@assignCar');
		Route::post('remove-customer-car', 'CarsController@unassignCar');
		Route::post('get-cust-car', 'CarsController@getCustCar');
		Route::post('search-workshop', 'WorkshopsController@searchByWorkshop');
	});
});
Route::group(['prefix'=>'workshop'], function() {
	Route::post('register', 'WorkshopsController@register');
	Route::post('login', 'WorkshopsController@login');
	Route::post('recover', 'WorkshopsController@recover');    
});
Route::group(['middleware' => 'conf_guard:Workshop'], function(){
	Route::group(['prefix'=>'workshop','middleware' => ['jwt.auth']], function() {  
		Route::post('logout', 'WorkshopsController@logout');
		Route::post('completeprofile', 'WorkshopsController@completeprofileinfo');
	});
});
