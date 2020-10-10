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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('show', 'PostController@show')->name('show');

Route::middleware('auth:api')->group(function () {
    Route::post('store', 'PostController@store')->name('store');
    Route::post('edit/{post}', 'PostController@edit')->name('edit');
    Route::post('update/{post}', 'PostController@update')->name('update');
    Route::post('destroy/{post}', 'PostController@destroy')->name('destroy');
});
