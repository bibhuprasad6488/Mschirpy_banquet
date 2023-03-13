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

Route::get('/google_social','Api\AuthenticationController@googleSocial');
Route::post('/googlesocial','Api\AuthenticationController@socialLogin');
Route::post('/callback','Api\AuthenticationController@callback');

Route::get('/list_show','Api\AuthenticationController@list_show');
Route::post('/addcuisine','Api\AuthenticationController@addcuisine');
