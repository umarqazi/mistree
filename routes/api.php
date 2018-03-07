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

Route::group(['middleware' => 'conf_guard:Customer'], function(){
	Route::get('cars', 'CarsController@index');
});


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

		Route::get('cars', 'CarsController@getCustomerCar');
		Route::post('car', 'CarsController@assignCar');
		Route::patch('car', 'CarsController@unassignCar');
		Route::post('search-workshop', 'WorkshopsController@searchWorkshop');
		Route::post('search-service', 'ServicesController@searchService');
		Route::post('amount-paid', 'BookingsController@customerpaidbill');
		Route::get('vehicle-history', 'CustomersController@getVehicleHistory');		

//		Route For Customer Password Reset
      Route::post('password-reset', 'CustomersController@passwordReset');
      Route::get('profile', 'CustomersController@getCustomerAddressAndCars');
      Route::post('add-customer-address', 'CustomersController@addCustomerAddress');
      Route::put('edit-customer-address', 'CustomersController@editCustomerAddress');
      Route::delete('delete-customer-address', 'CustomersController@deleteCustomerAddress');

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
		Route::get('profile', 'WorkshopsController@getWorkshop');
		Route::put('profile', 'WorkshopsController@profileUpdate');
		Route::post('insert-service', 'WorkshopsController@insertService');
		Route::patch('update-service/{service_id}', 'WorkshopsController@updateService');
		
		Route::get('address', 'WorkshopsController@getAddress');
		Route::post('update-address', 'WorkshopsController@updateAddress');
		Route::post('update-images','WorkshopsController@updateImages');
		Route::patch('update-profile-image','WorkshopsController@updateProfileImage');	
		Route::patch('unassign-service/{service_id}','WorkshopsController@unassignService');		
		Route::get('services','WorkshopsController@workshopServices');
		Route::post('createbooking','BookingsController@createBooking');
		Route::patch('accept-booking/{booking_id}','BookingsController@acceptBooking');
		Route::patch('reject-booking/{booking_id}','BookingsController@rejectBooking');		
		Route::post('complete-job','BookingsController@completeLead');
		Route::get('ledger','WorkshopsController@getLedger');
		Route::get('leads-info','BookingsController@getLeadsInfo');
		Route::get('history','BookingsController@leadsHistory');
		Route::get('leads/accepted','BookingsController@acceptedLeads');
		Route::get('leads/rejected','BookingsController@rejectedLeads');
		Route::get('leads/completed','BookingsController@completedLeads');

//		Route For Workshop Password Reset
        Route::post('password-reset', 'WorkshopsController@passwordReset');
    });
});
