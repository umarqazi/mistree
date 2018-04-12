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

Route::group(['middleware'	=> 'conf_guard:admin'], function(){
	Route::group(['middleware' => 'auth.basic.once'], function(){
		Route::post('topup', 'WorkshopsController@jazzCashTopup');
	});
});

Route::group(['middleware' => 'conf_guard:Customer'], function(){
	Route::group(['middleware' => ['jwt.auth']], function(){
		Route::get('cars', 'CarsController@index');
	});
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
		Route::get('resendverification', 'CustomerAuth\RegisterController@resendVerificationEmail');

		Route::get('cars', 'CarsController@getCustomerCar');
		Route::post('car', 'CarsController@assignCar');
		Route::patch('car', 'CarsController@unassignCar');
		Route::post('search-workshop', 'WorkshopsController@searchWorkshop');
		Route::post('search-service', 'ServicesController@searchService');
		Route::post('create-booking','BookingsController@createBooking');
		Route::get('bookings', 'BookingsController@customerBookings');
		Route::get('bookings/{booking}', 'BookingsController@getCustomerBooking');
		Route::post('billing/{billing_id}/amount-paid', 'BookingsController@customerpaidbill');
		Route::post('billing/receipt', 'BookingsController@customerReceipt');
		Route::get('vehicle-history', 'CustomersController@getVehicleHistory');
		Route::patch('leave-rating/{billing_id}', 'CustomersController@insertRatings');
		Route::get('get-workshop/{workshop_id}','CustomersController@getWorkshopDetails');

//		Route For Customer Password Reset
		Route::post('password-reset', 'CustomersController@passwordReset');
		Route::get('profile', 'CustomersController@getCustomerAddressAndCars');
		Route::post('add-customer-address', 'CustomersController@addCustomerAddress');
		Route::put('edit-customer-address', 'CustomersController@editCustomerAddress');
		Route::delete('delete-customer-address', 'CustomersController@deleteCustomerAddress');
		Route::resource('customer-queries', 'CustomerQueriesController', ['only' => ['store']]);
        Route::get('queries', 'CustomerQueriesController@customerQueries');
		Route::patch('update-profile-image','CustomersController@updateProfileImage');

		Route::patch('contact-info', 'CustomersController@updateDetails');
	});
});
Route::group(['middleware' => 'conf_guard:Workshop'], function(){
	Route::get('services', 'ServicesController@filteredServices');
	Route::get('sign-up/services', 'ServicesController@index');
	Route::post('service-against-car-id', 'ServicesController@serviceAgainstCarId');
});
Route::group(['prefix'=>'workshop'], function() {
	Route::post('register', 'WorkshopsController@register');
	Route::post('login', 'WorkshopsController@login');
	Route::post('recover', 'WorkshopsController@recover');
});
Route::group(['middleware' => 'conf_guard:Workshop'], function(){
	Route::group(['prefix'=>'workshop','middleware' => ['jwt.auth']], function() {

		Route::post('logout', 'WorkshopsController@logout');
		Route::post('verifyEmail', 'WorkshopsController@verifyEmail');
		Route::get('resendverification', 'WorkshopAuth\RegisterController@resendVerificationEmail');
		Route::post('completeprofile', 'WorkshopsController@completeprofileinfo');
		Route::get('profile', 'WorkshopsController@getWorkshop');
		Route::patch('profile', 'WorkshopsController@profileUpdate');
		Route::post('service', 'WorkshopsController@insertService');
		Route::patch('service', 'WorkshopsController@updateService');
		Route::delete('service','WorkshopsController@unassignService');

		Route::get('address', 'WorkshopsController@getAddress');
		Route::post('address', 'WorkshopsController@updateAddress');
		Route::post('update-image','WorkshopsController@updateImages');
		Route::patch('update-profile-image','WorkshopsController@updateProfileImage');
		Route::patch('update-cnic-image','WorkshopsController@updateCnicImage');
		Route::get('services','WorkshopsController@workshopServices');
		Route::patch('accept-booking/{booking}','BookingsController@acceptBooking');
		Route::patch('reject-booking/{booking_id}','BookingsController@rejectBooking');
		Route::get('start-job/{lead}', 'BookingsController@startLead');
		Route::post('complete-job','BookingsController@completeLead');

		Route::get('ledger','WorkshopsController@getLedger');
		Route::get('leads-info','BookingsController@getLeadsInfo');
		Route::get('history','BookingsController@leadsHistory');
		Route::get('leads/lead-info/{lead}', 'BookingsController@getWorkshopLead');
		Route::get('leads/accepted','BookingsController@acceptedLeads');
        Route::get('leads/rejected','BookingsController@rejectedLeads');
        Route::get('leads/completed','BookingsController@completedLeads');
        Route::get('leads/expired','BookingsController@expiredLeads');
        Route::patch('lead/{booking_id}/enter-millage', 'BookingsController@insertMillage');
		Route::get('leads/pending', 'BookingsController@pendingLeads');

//		Route For Workshop Password Reset
		Route::post('password-reset', 'WorkshopsController@passwordReset');
//		Route For Workshop Support Query
//      Route For Workshop Customers
		Route::get('get-customers', 'WorkshopsController@getCustomers');
		Route::resource('workshop-queries', 'WorkshopQueriesController', ['only' => [ 'store', 'index']]);
        Route::get('queries', 'WorkshopQueriesController@workshopQueries');
		Route::patch('contact-info', 'WorkshopsController@updateDetails');
	});
});
