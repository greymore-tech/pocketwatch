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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

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
