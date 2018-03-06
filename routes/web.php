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

Route::group(['prefix' => 'customer'], function () {
  /*  Route::get('/login', 'CustomerAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'CustomerAuth\LoginController@login');
    Route::post('/logout', 'CustomerAuth\LoginController@logout')->name('logout');

    Route::get('/register', 'CustomerAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'CustomerAuth\RegisterController@register');*/

    Route::post('/password/email', 'CustomerAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'CustomerAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'CustomerAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'CustomerAuth\ResetPasswordController@showResetForm');
    Route::get('/verify/{verification_code}', 'CustomersController@verifyEmail');
});
// ========= Customer Routes Start ==================================================
// ========= Customer Routes End ===================================================
// ========= Worshop Routes Start ==================================================
Route::group(['middleware' => 'admin.guest'], function (){
    Route::group(['middleware' => 'workshop'], function (){
        
        Route::get('/history', 'WorkshopsController@show_history');
        Route::get('/customers', 'WorkshopsController@show_customers');
        Route::get('/requests', 'WorkshopsController@show_requests');

        Route::get('/profile', 'WorkshopsController@workshop_profile');
    });

    Route::get('/', 'WorkshopAuth\LoginController@showLoginForm')->name('login');
    Route::post('/login', 'WorkshopAuth\LoginController@login');
    Route::post('/logout', 'WorkshopAuth\LoginController@logout')->name('logout');



    // Route::get('/register', 'WorkshopAuth\RegisterController@showRegistrationForm')->name('register');
    Route::post('/register', 'WorkshopAuth\RegisterController@register');

    Route::post('/password/email', 'WorkshopAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
    Route::post('/password/reset', 'WorkshopAuth\ResetPasswordController@reset')->name('password.email');
    Route::get('/password/reset', 'WorkshopAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
    Route::get('/password/reset/{token}', 'WorkshopAuth\ResetPasswordController@showResetForm');
    Route::get('/verify/{verification_code}', 'WorkshopsController@verifyEmail');

});

// ========= Worshop Routes End ===================================================
// ========= Admin Routes Start ===================================================

Route::group(['prefix' => 'admin', 'middleware' => 'workshop.guest'], function () {

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
        Route::resource('customers', 'CustomersController');
        Route::resource('workshops', 'WorkshopsController');
        Route::resource('services', 'ServicesController');
        Route::resource('workshop-queries', 'WorkshopQueriesController');
        Route::get('/dashboard','AdminsController@home');

        Route::get('/edit-workshop-service/{id}', 'WorkshopsController@editWorkshopService');
        Route::get('/add-workshop-service/{workshop}', 'WorkshopsController@addWorkshopService');
        Route::post('/store-workshop-service/', 'WorkshopsController@storeWorkshopService');
        Route::get('/delete-workshop-service/{workshop}/{service}', 'WorkshopsController@deleteWorkshopService');
        Route::post('/update-workshop-service/', 'WorkshopsController@updateWorkshopService');

        Route::get('/activate-customer/{id}', 'CustomersController@activateCustomer');
        Route::get('/deactivate-customer/{id}', 'CustomersController@deactivateCustomer');
        Route::get('/approve-workshop/{id}', 'WorkshopsController@approveWorkshop');
        Route::get('/undo-approval-workshop/{id}', 'WorkshopsController@undoWorkshopApproval');
    });

  // ========= Admin Routes End ==================================================
  
});


