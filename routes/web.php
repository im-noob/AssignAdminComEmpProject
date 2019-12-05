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

Auth::routes();


Route::group(['middleware'=>'Admin' ], function () {
    Route::get('AdminHome', function(){
        return view('admin.home');
    });

});


Route::group(['middleware'=>'Company' ], function () {
    Route::get('CompanyHome', function(){
        return view('company.home');
        
    });
});

//disabling registration
Route::get('register', function () {
    echo "<h1>Curently Disabled</h1>";
});
