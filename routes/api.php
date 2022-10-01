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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/giftRegister', "App\Http\Controllers\API\CRM\GiftController@giftRegister");
Route::post('/getGiftCategories', "App\Http\Controllers\API\CRM\GiftController@getGiftCategories");
Route::post('/getGiftSubCategories', "App\Http\Controllers\API\CRM\GiftController@getGiftSubCategories");
