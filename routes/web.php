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

use Illuminate\Http\Resources\Json\Resource;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

//disabling registration
Route::get('register', function () {
    echo "<h1>Curently Disabled</h1>";
});


Route::group(['middleware'=>'Admin' ], function () {
    Route::get('AdminHome', 'CompaniesController@indexAll');
    Route::resource('companies', 'CompaniesController');
    Route::resource('employees', 'EmployeesController');


});


Route::group(['middleware'=>'Company' ], function () {
    // Route::get('CompanyHome', function(){
    //     return view('company.home');
    // });
    Route::get('CompanyHome', 'CompaniesController@indexAll');

    Route::resource('employeesForCompany', 'EmployeesController');

});

