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
		Route::get('get-customer-car', 'CarsController@getCustomerCar');
		Route::post('search-workshop', 'WorkshopsController@searchWorkshop');
		Route::post('search-service', 'ServicesController@searchService');
		Route::post('amount-paid', 'BookingsController@customerpaidbill');
	});
});
Route::group(['prefix'=>'workshop'], function() {
	Route::post('register', 'WorkshopsController@register');
	Route::get('getServices', 'ServicesController@index');
	Route::post('login', 'WorkshopsController@login');
	Route::post('recover', 'WorkshopsController@recover');    
});
Route::group(['middleware' => 'conf_guard:Workshop'], function(){
	Route::group(['prefix'=>'workshop','middleware' => ['jwt.auth']], function() {  
		Route::get('logout', 'WorkshopsController@logout');
		Route::post('verifyEmail', 'WorkshopsController@verifyEmail');
		Route::post('completeprofile', 'WorkshopsController@completeprofileinfo');
		Route::get('getWorkshop/{id}', 'WorkshopsController@getWorkshop');
		Route::patch('updateProfile/{id}', 'WorkshopsController@profileUpdate');
		Route::resource('address', 'WorkshopAddressesController');
		Route::post('deleteWorkshopService/{workshop_id}/{service_id}','WorkshopsController@unassignService');		
		Route::get('workshopServices/{workshop_id}','WorkshopsController@allWorkshopServices');
		Route::post('createbooking','BookingsController@createBooking');
		Route::post('acceptbooking/{workshop_id}/{booking_id}','BookingsController@acceptBooking');
		Route::post('rejectbooking/{workshop_id}/{booking_id}','BookingsController@rejectBooking');
		Route::post('booking-bill','BookingsController@bookingBiling');				
		Route::post('complete-job','BookingsController@workshopcompletejob');						
	});
});
