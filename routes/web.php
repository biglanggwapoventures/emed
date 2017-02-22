<?php

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

//show login page
Route::get('/login', 'LoginController@showLoginPage')->middleware('guest');

// log out user
Route::get('/logout', 'LogoutController');

Route::get('/admin', 'AdminController@showHomepage')->middleware('auth');

//process login data
Route::post('/login', 'LoginController@doLogin');

Route::resource('doctors', 'DoctorsController');
Route::resource('users', 'UsersController');
Route::resource('managers', 'ManagersController');
Route::resource('patients', 'PatientsController');

