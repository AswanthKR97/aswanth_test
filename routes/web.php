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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/user-registration', 'users\UsersController');
Route::get('/edit-user/{id}', 'users\UsersController@edit')->name('edit-user');
// Route::get('/sendmail', 'users\UsersController@sendmail')->name('sendmail');
Route::post('/verify-otp', 'users\UsersController@verifyOTP')->name('verify-otp');
