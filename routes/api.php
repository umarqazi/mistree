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

Route::post('registerCust', 'CustomersController@register');
Route::post('loginCust', 'CustomersController@login');
Route::post('recoverCust', 'CustomersController@recover');

Route::group(['middleware' => ['jwt.auth']], function() {
    Route::get('logoutCust', 'CustomersController@logout');
});