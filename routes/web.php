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

Route::get('/', function () {
    return view('welcome');
});

// Routes for template by Adeel

Route::get('/dashboard', function () {
    return view('dashboard.dashboard');
});

// Routes for Hesto Package by Haris

Route::group(['prefix' => 'customer'], function () {
  Route::get('/login', 'CustomerAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'CustomerAuth\LoginController@login');
  Route::post('/logout', 'CustomerAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'CustomerAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'CustomerAuth\RegisterController@register');

  Route::post('/password/email', 'CustomerAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'CustomerAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'CustomerAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'CustomerAuth\ResetPasswordController@showResetForm');
  Route::get('/verify/{verification_code}', 'CustomerAuth@verifyCustomer');
});

Route::group(['prefix' => 'workshop'], function () {
  Route::get('/login', 'WorkshopAuth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'WorkshopAuth\LoginController@login');
  Route::post('/logout', 'WorkshopAuth\LoginController@logout')->name('logout');

  Route::get('/register', 'WorkshopAuth\RegisterController@showRegistrationForm')->name('register');
  Route::post('/register', 'WorkshopAuth\RegisterController@register');

  Route::post('/password/email', 'WorkshopAuth\ForgotPasswordController@sendResetLinkEmail')->name('password.request');
  Route::post('/password/reset', 'WorkshopAuth\ResetPasswordController@reset')->name('password.email');
  Route::get('/password/reset', 'WorkshopAuth\ForgotPasswordController@showLinkRequestForm')->name('password.reset');
  Route::get('/password/reset/{token}', 'WorkshopAuth\ResetPasswordController@showResetForm');
  Route::get('/verify/{verification_code}', 'WorkshopAuth@verifyWorkshop');

  Route::resource('/', 'WorkshopsController');
});

Route::group(['prefix' => 'admin'], function () {

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
  Route::resource('customers', 'CustomersController');
  Route::resource('workshops', 'WorkshopsController');

});
