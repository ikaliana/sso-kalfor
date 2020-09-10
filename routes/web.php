<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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
    session()->forget('status');
    return redirect( Auth::check() ? 'login' : 'home' );
    //return view('welcome');
});

Auth::routes(['verify' => true]);

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logoutsso', 'SsoServiceController@Logout')->name('logoutsso');
Route::middleware('auth')->get('/settings', 'SsoServiceController@Settings')->name('settings');
Route::middleware('auth')->get('/password/change', 'UserController@showChangePasswordForm')->name('changepasswordget');
Route::middleware('auth')->post('/password/change', 'UserController@submitChangePassword')->name('changepasswordpost');

Route::middleware('auth')->get('/applications', function () {
    return view('applications');
})->name('applications')->middleware('verified');
