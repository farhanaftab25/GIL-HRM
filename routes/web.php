<?php

use App\Employee;
use App\Product;
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
    return view('welcome');
});


Auth::routes();

Route::middleware('auth')->group(function () {
    Route::get('/admin', 'AdminController@index')->name('admin.index');
    Route::resource('designations', 'DesignationController');
    Route::resource('employees', 'EmployeeController');
    Route::get('/getSalary', function () {
        return Employee::with('designation')->latest('id')->get();
    });
});
