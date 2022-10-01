<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/gift-registration/{shortcode}', 'App\Http\Controllers\API\CRM\GiftController@registrationPage');
Route::post('/giftRegister', "App\Http\Controllers\API\CRM\GiftController@giftRegister");
Route::get('/scratchcard/{shortcode}', function() {
	return view('scratchcard');
})->name('scratchcard');


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
