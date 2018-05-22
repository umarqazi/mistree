<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::post('profile/store-profile-service', 'WorkshopsController@storeProfileService');
// ========= Customer Routes Start ==================================================
Route::group(['prefix' => 'customer'], function () {
    Route::post('/password/email', 'CustomerAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'CustomerAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'CustomerAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'CustomerAuth\ResetPasswordController@showResetForm');
    Route::get('/verify/{verification_code}', 'CustomersController@verifyEmail');
    Route::get('successfully-recover', function (){
        return view('customer.successfullyRecover');
    });
});
// ========= Customer Routes End ===================================================
// ========= Worshop Routes Start ==================================================
Route::group(['middleware' => 'admin.guest'], function (){

//    Route::get('/', function(){
//        return redirect()->route('home');
//    });
    Route::get('/', 'WorkshopsController@frontPage');
    Route::get('/login', 'WorkshopAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'WorkshopAuth\LoginController@login');
    Route::post('/logout', 'WorkshopAuth\LoginController@logout')->name('logout');

    Route::get('/register', 'WorkshopAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'WorkshopAuth\RegisterController@register');

    Route::post('/password/email', 'WorkshopAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'WorkshopAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'WorkshopAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'WorkshopAuth\ResetPasswordController@showResetForm');
    Route::get('/verify/{verification_code}', 'WorkshopsController@verifyEmail');


    Route::group(['middleware' => 'workshop'], function (){

        Route::get('/customers', 'WorkshopsController@show_customers');
        Route::get('/requests', 'WorkshopsController@show_requests');

        Route::get('/home', 'WorkshopsController@showHome')->name('home');
        Route::get('/profile', 'WorkshopsController@workshop_profile');
        Route::get('/gallery', 'WorkshopsController@workshop_gallery');
        Route::get('/profile/{id}/edit', 'WorkshopsController@edit_profile');
        Route::patch('/profile/{id}', 'WorkshopsController@update_profile');
        Route::get('/ledger', 'WorkshopsController@getLedger');

        Route::get('profile/add-profile-service/{workshop}', 'WorkshopsController@addProfileService');
        Route::post('/get-category-services','WorkshopsController@getCategoryServices');
        Route::get('profile/edit-profile-service/{id}', 'WorkshopsController@editProfileService');
        Route::get('change-password/', 'WorkshopsController@changePassword');
        Route::patch('reset-password/', 'WorkshopsController@passwordReset');
        Route::patch('profileServiceUpdate', 'WorkshopsController@updateProfileService');
        
        Route::get('profile/delete-profile-service/{workshop}/{service}', 'WorkshopsController@deleteProfileService');
        Route::resource('workshop-queries', 'WorkshopQueriesController', ['only' => [ 'create']]);
        Route::post('workshop-queries', 'WorkshopQueriesController@storeWeb');
        Route::get('queries', 'WorkshopQueriesController@workshopQueries');

        
        Route::get('leads','BookingsController@leadsHistory');
        Route::get('leads/accepted','BookingsController@acceptedLeads');
        Route::get('leads/rejected','BookingsController@rejectedLeads');
        Route::get('leads/expired','BookingsController@expiredLeads');
        Route::get('leads/completed','BookingsController@completedLeads');
        Route::get('/notifications', 'NotificationsController@index');

    });

});
// ========= Worshop Routes End ===================================================
// ========= Admin Routes Start ===================================================

Route::group(['prefix' => 'admin', 'middleware' => 'workshop.guest'], function () {

  Route::get('/', function(){
      return redirect()->route('admin.home');
  });
  Route::get('/login', 'AdminAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'AdminAuth\LoginController@login');
  Route::post('/logout', 'AdminAuth\LoginController@logout')->name('logout');
   
  Route::get('/register', function (){
      return redirect()->route('login');
  });

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

  //  Web portal

    Route::group(['middleware' => 'admin'], function (){

        Route::get('/workshops/block', 'WorkshopsController@inactive_workshops');
        Route::get('/workshops/{id}/unblock', 'WorkshopsController@restore');
        Route::get('/pending-workshops', 'WorkshopsController@pending_workshops');
        Route::get('/workshops/{id}/approve', 'WorkshopsController@approveWorkshop');

        Route::resource('customers', 'CustomersController');
        Route::resource('workshops', 'WorkshopsController');
        Route::resource('services', 'ServicesController');
        Route::resource('workshop-queries', 'WorkshopQueriesController', ['except' => [ 'create', 'edit','store']]);
        Route::resource('customer-queries', 'CustomerQueriesController', ['except' => [ 'create', 'edit','store']]);
        Route::resource('cars', 'CarsController');
        Route::delete('car/{id}', 'CarsController@delete_car');
        Route::put('resolve-workshop-query/{workshopQuery}', 'WorkshopQueriesController@resolve');
        Route::put('resolve-customer-query/{customerQuery}', 'CustomerQueriesController@resolve');
        Route::get('/home','AdminsController@showHome')->name('admin.home');

        Route::get('/inactive-cars', 'CarsController@inactive_cars');
        Route::post('/car/restore/{id}', 'CarsController@restore');
        Route::get('/service/inactive', 'ServicesController@inactive_services');
        Route::post('/services/restore/{id}', 'ServicesController@restore');

        Route::get('/unpublished/cars', 'CarsController@unPublished');  
        Route::patch('/car/publish/', 'CarsController@publish');                   
        
        
        Route::get('/edit-workshop-service/{id}', 'WorkshopsController@editWorkshopService');
        Route::get('/add-workshop-service/{workshop}', 'WorkshopsController@addWorkshopService');
        Route::post('/get-category-services','WorkshopsController@getCategoryServices');
        Route::post('/store-workshop-service/', 'WorkshopsController@storeWorkshopService');
        Route::get('/delete-workshop-service/{workshop}/{service}', 'WorkshopsController@deleteWorkshopService');
        Route::post('/update-workshop-service/', 'WorkshopsController@updateWorkshopService');
        Route::get('/edit-workshop-password/{workshop}', 'WorkshopsController@editWorkshopPassword');
        Route::patch('/update-workshop-password/', 'WorkshopsController@updateWorkshopPassword');

        Route::post('customers/{id}/unblock/', 'CustomersController@restore');
        Route::get('/blocked-customers', 'CustomersController@blockedCustomers');
        Route::get('/approve-workshop/{id}', 'WorkshopsController@approveWorkshop');

        Route::get('/top-up', 'WorkshopsController@topup');
        Route::post('/update-balance', 'WorkshopsController@topupBalance');

        Route::get('/booking/{type?}', 'BookingsController@bookingListings');
        Route::get('/total-revenue', 'BookingsController@totalRevenue');
        Route::get('all-workshops/top-up', 'WorkshopsController@topupDetails');

        Route::get('/authorized-workshops', 'WorkshopsController@authorized');
        Route::get('/unauthorized-workshops', 'WorkshopsController@unauthorized');

        Route::get('workshop/{workshop}/history', 'BookingsController@workshopHistory');
        Route::get('workshop/{workshop}/history/rejected-leads', 'BookingsController@workshopRejectedLeads');                
        Route::get('workshop/{workshop}/history/accepted-leads', 'BookingsController@workshopAcceptedLeads');                
        Route::get('workshop/{workshop}/history/completed-leads', 'BookingsController@workshopCompletedLeads');                
        Route::get('workshop/{workshop}/ledger', 'WorkshopsController@workshopLedger');
        Route::post('adjustment', 'WorkshopsController@ledgerAdjustment');
        Route::get('workshop/{workshop}/gallery', 'WorkshopsController@workshopGallery');
        Route::get('/notifications', 'NotificationsController@index');
                
    });

});


/* ========= Admin Routes End ====================================================== */

/* ========= Other Routes Starts ====================================================== */
/*Notification Routes*/
        Route::get('/notifications/markasread', 'NotificationsController@markOneAsRead');
/*Terms And Conditions*/
        Route::get('/terms', function (){
            return view('workshop/terms_and_conditions');
        });

/* ========= Other Routes Ends ====================================================== */
