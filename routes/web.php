<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;

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
##login
Route::get('login', [AuthController::class, 'index'])->name('login');
Route::post('post-login', [AuthController::class, 'postLogin'])->name('login.post'); 
Route::get('logout', [AuthController::class, 'logout'])->name('logout');


## View 
Route::get('/company', 'CompanyController@index')->name('company');

## Create
Route::get('/company/create', 'CompanyController@create')->name('company.create');
Route::post('/company/store', 'CompanyController@store')->name('company.store');
##view
Route::get('/company/view/{id}', 'CompanyController@view')->name('company.view');
## Update
Route::get('/company/store/{id}', 'CompanyController@edit')->name('company.edit');
Route::post('/company/update/{id}', 'CompanyController@update')->name('company.update');

## Delete
Route::get('/company/delete/{id}', 'CompanyController@destroy')->name('company.delete');
//employees
## View 
Route::get('/employee', 'EmployeeController@index')->name('employee');
## Create
Route::get('/employee/create', 'EmployeeController@create')->name('employees.create');
Route::post('/employee/store', 'EmployeeController@store')->name('employees.store');
##view
Route::get('/employee/view/{id}', 'EmployeeController@view')->name('employees.view');
## Update
Route::get('/employee/store/{id}', 'EmployeeController@edit')->name('employees.edit');
Route::post('/employee/update/{id}', 'EmployeeController@update')->name('employees.update');

## Delete
Route::get('/employee/delete/{id}', 'EmployeeController@destroy')->name('employees.delete');
