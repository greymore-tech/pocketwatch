<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'app'], function () {
    Route::post('/login', 'APIUserController@login');
    Route::post('/register', 'APIUserController@register');
    Route::get('/logout', 'APIUsersController@logout')->middleware('auth:api');
});

// API VERIFICATION AND PASSWORD RESET AND FORGET
Route::post('/password/email', 'API\ForgotPasswordController@sendResetLinkEmail');
Route::post('/password/reset', 'API\ResetPasswordController@reset');
Route::get('/email/resend', 'API\VerificationController@resend')->name('verification.resend');
Route::get('/email/verify/{id}/{hash}', 'API\VerificationController@verify')->name('verification.verify');
Route::get('/verified','API\VerificationController@getStatus')->name('verification.check');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/verified-only', function(Request $request){
    dd('You are a verified user', $request->user()->name);
})->middleware('auth:api','verified');



//  Tabs API Route
Route::get('tabs/{user_id}', 'TabController@index');
Route::get('tab/{id}/{user_id}', 'TabController@show');
Route::post('tab/{user_id}', 'TabController@store');
Route::put('tab/{user_id}', 'TabController@update');
Route::delete('tab/{id}/{user_id}', 'TabController@destroy');

//  Items API Route
Route::get('items/{user_id}', 'ItemController@index');
Route::get('item/{id}/{tab_id}/{user_id}', 'ItemController@show');
Route::post('item/{tab_id}/{user_id}', 'ItemController@store');
Route::put('item/{tab_id}/{user_id}', 'ItemController@update');
Route::delete('item/{id}/{tab_id}/{user_id}', 'ItemController@destroy');
