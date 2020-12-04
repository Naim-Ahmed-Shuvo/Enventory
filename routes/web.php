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
    return view('backend.pages.dashboard');
});
Route::get('/modals', function () {
    return view('backend.modals');
});
Route::get('/dashboard', function () {
    return view('backend.pages.dashboard');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


// Employee
Route::resource('employee', 'EmployeeController');
Route::post('employee_update/{id}', 'EmployeeController@update');

// Customer
Route::resource('customer', 'CustomerController');
Route::post('employee_update/{id}', 'CustomerController@update');


// Suppliers
Route::resource('suppliers', 'SupplierController');
Route::post('sup_update/{id}', 'SupplierController@update');

// Salary
Route::resource('salary', 'SalaryController');
