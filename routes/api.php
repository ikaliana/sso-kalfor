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

// Route::middleware('auth:api')->group(function () {
Route::group(['middleware' => ['auth:api', 'verified']], function () {
    Route::get('/user','SsoServiceController@GetUserInfo');
    // Route::post('/logout','SsoServiceController@Logout');

	//tambahan taufiq
	//USER MANAGEMENT
	Route::get('/users', 'UserController@listUser');
	Route::get('/users/{id}', 'UserController@singleUser');
	Route::post('/users', 'UserController@addUser');
	Route::put('/users/{id}', 'UserController@updUser');
	Route::delete('/users/{id}', 'UserController@delUser');

	//ROLE MANAGEMENT
	Route::get('/roles', 'RolesController@listRoles');
	Route::get('/roles/{id}', 'RolesController@singleRole');
	Route::post('/roles', 'RolesController@addRole');
	Route::put('/roles/{id}', 'RolesController@updRole');
	Route::delete('/roles/{id}', 'RolesController@delRole');

	//APPLICATION MANAGEMENT
	Route::get('/applications', 'ApplicationController@list');
	Route::get('/applications/{id}', 'ApplicationController@get');
	Route::post('/applications', 'ApplicationController@create');
	Route::put('/applications/{id}', 'ApplicationController@update');
	Route::delete('/applications/{id}', 'ApplicationController@delete');

	Route::get('/modules', 'ModulesController@list');
	Route::post('/modules', 'ModulesController@create');
	Route::delete('/modules/{id}', 'ModulesController@delete');

	//CHANGE PASSWORD
	Route::post('/password/change', 'UserController@submitChangePassword');

});

Route::middleware('verified')->post('/password/reset', 'UserController@resetPassword');
Route::middleware('auth:api')->post('/logout','SsoServiceController@Logout');
Route::post('/users/register', 'UserController@registerUser');

Route::get('/apps', 'ApplicationController@list');
Route::get('/apps/{id}', 'ApplicationController@get');
Route::post('/apps', 'ApplicationController@create');
Route::put('/apps/{id}', 'ApplicationController@update');
Route::delete('/apps/{id}', 'ApplicationController@delete');

