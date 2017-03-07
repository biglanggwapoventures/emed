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
Route::get('/pmanager-home', 'ManagersController@showHomepage')->middleware('auth');
Route::get('/pharmacists', 'ManagersController@phlist');
Route::get('/pharmacists-home', 'PharmaController@showHomepage')->middleware('auth');

Route::get('/patient-home', 'PatientsController@showHomepage');
// Route::get('/doctor-home', 'DoctorsController@showHomepage');

/* LANDING PAGE */
Route::get('/patient-home', 'PatientsController@showHomepage')->middleware('auth');
Route::get('/doctor-home', 'DoctorsController@showHomepage')->middleware('auth');
Route::get('/aboutus', 'OtherController@aboutus');
Route::get('/contactus', 'OtherController@contactus');
Route::get('/faq', 'OtherController@faq');

Route::get('/admin', 'AdminController@showHomepage')->middleware('auth');
// Route::get('/edit-doc', 'AdminController@editDoc');
//process login data
Route::post('/login', 'LoginController@doLogin');

Route::resource('doctors', 'DoctorsController');
Route::resource('admin', 'AdminController');
Route::resource('users', 'UsersController');
Route::resource('managers', 'ManagersController');
Route::resource('patients', 'PatientsController');
Route::resource('secretary', 'SecretaryController');
Route::resource('pharmacists', 'PharmaController');
// Route::resource('pharmacists', 'PharmaController');

Route::post('/upload-display-photo', 'FileUploadController@uploadDisplayPhoto')->name('upload.dp');

