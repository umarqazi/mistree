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

    Route::get('/', function(){
        return redirect()->route('home');
    });
    Route::get('/login', 'WorkshopAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'WorkshopAuth\LoginController@login');
    Route::post('/logout', 'WorkshopAuth\LoginController@logout')->name('logout');


    Route::post('/register', 'WorkshopAuth\RegisterController@register');

    Route::post('/password/email', 'WorkshopAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'WorkshopAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'WorkshopAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'WorkshopAuth\ResetPasswordController@showResetForm');
    Route::get('/verify/{verification_code}', 'WorkshopsController@verifyEmail');


    Route::group(['middleware' => 'workshop'], function (){

        Route::get('/history', 'WorkshopsController@show_history');
        Route::get('/customers', 'WorkshopsController@show_customers');
        Route::get('/requests', 'WorkshopsController@show_requests');

        Route::get('/home', 'WorkshopsController@showHome')->name('home');
        Route::get('/profile', 'WorkshopsController@workshop_profile');
        Route::get('/profile/{id}/edit', 'WorkshopsController@edit_profile');
        Route::post('/profile/{id}', 'WorkshopsController@update_profile');

        Route::get('profile/add-profile-service/{workshop}', 'WorkshopsController@addProfileService');
        Route::get('profile/edit-profile-service/{id}', 'WorkshopsController@editProfileService');
        Route::patch('profile/updateProfileService/', 'WorkshopsController@updateProfileService');
        Route::get('/profile', 'WorkshopsController@workshop_profile');
        
        Route::get('profile/delete-profile-service/{workshop}/{service}', 'WorkshopsController@deleteProfileService');
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
   

  Route::get('/register', 'AdminAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'AdminAuth\RegisterController@register');

  Route::post('/password/email', 'AdminAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'AdminAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'AdminAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'AdminAuth\ResetPasswordController@showResetForm');

  //  Web portal

    Route::group(['middleware' => 'admin'], function (){

        Route::get('/workshops/block', 'WorkshopsController@inactive_workshops');
        Route::get('/workshops/{id}/unblock', 'WorkshopsController@restore');

        Route::resource('customers', 'CustomersController');
        Route::resource('workshops', 'WorkshopsController');
        Route::resource('services', 'ServicesController');
        Route::resource('cars', 'CarsController');
        Route::get('/home','AdminsController@home')->name('admin.home');

        Route::get('/inactive-cars', 'CarsController@inactive_cars');
        Route::post('/car/restore/{id}', 'CarsController@restore');
        Route::get('/service/inactive', 'ServicesController@inactive_services');
        Route::post('/services/restore/{id}', 'ServicesController@restore');

        Route::get('/unpublished/cars', 'CarsController@unPublished');  
        Route::patch('/car/publish/', 'CarsController@publish');                   
        
        
        Route::get('/edit-workshop-service/{id}', 'WorkshopsController@editWorkshopService');
        Route::get('/add-workshop-service/{workshop}', 'WorkshopsController@addWorkshopService');
        Route::post('/store-workshop-service/', 'WorkshopsController@storeWorkshopService');
        Route::get('/delete-workshop-service/{workshop}/{service}', 'WorkshopsController@deleteWorkshopService');
        Route::post('/update-workshop-service/', 'WorkshopsController@updateWorkshopService');

        Route::get('/activate-customer/{id}', 'CustomersController@activateCustomer');
        Route::get('/deactivate-customer/{id}', 'CustomersController@deactivateCustomer');
        Route::get('/approve-workshop/{id}', 'WorkshopsController@approveWorkshop');

        Route::get('/top-up', 'WorkshopsController@topup');
        Route::post('/update-balance', 'WorkshopsController@topupBalance');        
         
    });

});


/* ========= Admin Routes End ====================================================== */