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


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'LoginController@redirectDefaultPage');


//show login page
Route::get('/login', 'LoginController@showLoginPage')->middleware('guest');

// log out user
Route::get('logout', 'LogoutController');
Route::get('/pharmacists', 'ManagersController@phlist');
Route::get('/pharmacists-home', 'PharmaController@showHomepage')->middleware('auth');
Route::get('/secretary-home', 'SecretaryController@showHomepage');

Route::get('/patient-home', 'PatientsController@showHomepage');
Route::get('/pharma-transaction', 'ManagersController@transaction');
// Route::get('/doctor-home', 'DoctorsController@showHomepage');

/* LANDING PAGE */
Route::get('/patient-home', 'PatientsController@showHomepage')->middleware('auth');
Route::get('doctor-home', 'DoctorsController@showHomepage')->middleware('auth');
Route::get('/pmanager-home', 'ManagersController@showHomepage')->middleware('auth');
Route::get('/aboutus', 'OtherController@aboutus');
Route::get('/contactus', 'OtherController@contactus');
Route::get('/faq', 'OtherController@faq');
Route::get('/downloads', 'OtherController@downloads');
Route::get('/downloadjar', 'DownloadsController@getDownload');
// Route::get('/ChangePass', 'OtherController@ChangePass');

Route::get('/admin', 'LoginController@redirectDefaultPage')->middleware('auth');
Route::get('/doctorlist', 'ListController@doctorList');
Route::get('/managerList', 'ListController@pmanagerList');
Route::get('/secretaryList', 'ListController@secretaryList');
Route::get('/pharmacistList', 'ListController@pharmaList');
// Route::get('/email', 'EmailController@index');
// Route::get('/edit-doc', 'AdminController@editDoc');
//process login data
Route::post('/login', 'LoginController@doLogin');

Route::resource('doctors', 'DoctorsController');
// Route::resource('admin', 'AdminController');
Route::resource('users', 'UsersController');
Route::resource('managers', 'ManagersController');
Route::resource('patients', 'PatientsController');
Route::resource('secretary', 'SecretaryController');
Route::resource('pharmacists', 'PharmaController');
Route::resource('consultations', 'MedicalHistoryController');
Route::resource('prescription', 'PrescriptionController');
Route::resource('transactions', 'TransactionsController');
Route::resource('specialization', 'SpecializationController');
Route::resource('drugstore', 'DrugstoreController');
Route::resource('pharmacy', 'PharmacyController');
Route::resource('affiliations', 'AffiliationsController');
Route::resource('organizations', 'OrganizationsController');
Route::resource('userroles', 'UserRolesController');
Route::resource('list', 'ListController');

// Route::resource('pharmacists', 'PharmaController');

Route::post('/upload-display-photo', 'FileUploadController@uploadDisplayPhoto')->name('upload.dp');

Route::post('/ChangePass', 'PasswordChangeController@postUpdatePassword')->name('ChangePass');
Route::get('/ChangePass', 'PasswordChangeController@showHomepage')->middleware('auth');

Route::post('/scan', 'RFIDController@scan');

Route::post('/detach-patient/{patientId}', 'PatientActionController@detachPatient')->name('patients.detach');
Route::post('/attach-patient/{patientId}', 'PatientActionController@attachPatient')->name('patients.attach');

Route::get('custom-role/{roleId}', 'CustomUserController@index')->name('customrole.index');
Route::get('custom-role/create/{roleId}', 'CustomUserController@create')->name('customrole.create');
Route::get('custom-role/edit/{userId}', 'CustomUserController@edit')->name('customrole.edit');
Route::get('home/{roleId}', 'CustomUserController@showHomepage')->name('customrole.show');

Route::post('custom-role/store/{roleId}', 'CustomUserController@store')->name('customrole.store');
Route::post('custom-role/update/{userId}', 'CustomUserController@update')->name('customrole.update');

Route::get('patient-prescriptions', 'PharmaTransactionController@index')->name('pharmatrans.index');
Route::get('nofloating-list', 'PatientsController@mypatients')->name('mypatients.list');

Route::get('pharmatransaction/{patientId}', 'PharmaTransactionController@transaction')->name('pharmatrans.transact');
Route::get('transaction-history', 'PharmaTransactionController@transactionList')->name('pharmatrans.history');

Route::post('transact', 'PharmaTransactionController@storeTransaction')->name('pharmatrans.store');
Route::post('void', 'PharmaTransactionController@voidTransaction')->name('pharmatrans.void');

Route::get('consultations/history/{consultationId}', 'MedicalHistoryController@listConsultationHist')->name('consultation.history');

Route::post('forgotpassword', 'PasswordChangeController@requestReset')->name('sendresetemail');
Route::get('reset/{userId}/{hashKey}', 'PasswordChangeController@resetPassword')->name('resetpassword');


Route::get('rfid/{uid}', 'CommonController@rfidAccess')->middleware('auth');

