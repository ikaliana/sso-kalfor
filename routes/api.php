<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

Route::middleware('auth:api')->group(function () {
    Route::get('/user','SsoServiceController@GetUserInfo');
    Route::post('/logout','SsoServiceController@Logout');
});

// Route::middleware('auth:api')->get('/user','SsoServiceController@GetUserInfo');
// Route::middleware('auth:api')->post('/logout','SsoServiceController@Logout');

