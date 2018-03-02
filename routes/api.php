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
		Route::post('billing/{billing_id}/amount-paid', 'BookingsController@customerpaidbill');
		Route::get('vehicle-history', 'CustomersController@getVehicleHistory');
		Route::patch('leave-rating/{billing_id}', 'CustomersController@insertRatings');
		Route::get('get-workshop/{workshop_id}','CustomersController@getWorkshopDetails');		

//		Route For Customer Password Reset
      Route::post('password-reset', 'CustomersController@passwordReset');
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
		Route::get('/', 'WorkshopsController@getWorkshop');
		Route::patch('update-profile', 'WorkshopsController@profileUpdate');
		Route::post('insert-service', 'WorkshopsController@insertService');
		Route::patch('update-service/{service_id}', 'WorkshopsController@updateService');
		
		Route::get('address', 'WorkshopsController@getAddress');
		Route::post('update-address', 'WorkshopsController@updateAddress');
		Route::post('update-images','WorkshopsController@updateImages');
		Route::patch('update-profile-image','WorkshopsController@updateProfileImage');	
		Route::patch('unassign-service/{service_id}','WorkshopsController@unassignService');		
		Route::get('services','WorkshopsController@workshopServices');
		Route::post('create-booking','BookingsController@createBooking');
		Route::patch('accept-booking/{booking_id}','BookingsController@acceptBooking');
		Route::patch('reject-booking/{booking_id}','BookingsController@rejectBooking');		
		Route::post('complete-job','BookingsController@completeLead');
		Route::get('ledger','WorkshopsController@getLedger');
		Route::get('leads-info','WorkshopsController@getLeadsInfo');
		Route::get('history','WorkshopsController@leadsHistory');
		Route::get('leads/accepted','WorkshopsController@acceptedLeads');
		Route::get('leads/rejected','WorkshopsController@rejectedLeads');
		Route::get('leads/completed','WorkshopsController@completedLeads');
		Route::patch('lead/{booking_id}/enter-millage', 'WorkshopsController@insertMillage');
//		Route For Workshop Password Reset
        Route::post('password-reset', 'WorkshopsController@passwordReset');
    });
});
