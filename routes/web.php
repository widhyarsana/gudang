<?php

use LaravelQRCode\Facades\QRCode;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;

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
    return redirect('/dashboard');
});

Auth::routes(['register' => false]);

Route::get('/dashboard', 'HomeController@index')->name('dashboard');

Route::middleware(['auth', 'role:superadmin'])->namespace('Superadmin')->prefix('superadmin')->name('superadmin.')->group(function () {
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/', 'AdminController@index')->name('index');
    });
});

Route::middleware(['auth', 'role:superadmin|admin'])->namespace('Admin')->name('admin.')->group(function () {
    Route::prefix('product')->name('product.')->group(function () {
        Route::get('/grain', 'GrainController')->name('grain.index');
        Route::get('/rice', 'RiceController')->name('rice.index');
        Route::get('/bran', 'BranController')->name('bran.index');
        Route::get('/menir', 'MenirController')->name('menir.index');
        Route::get('/broken', 'BrokenController')->name('broken.index');
    });

    Route::get('/partner', 'PartnerController')->name('partner.index');
    Route::get('/employee', 'EmployeeController')->name('employee.index');

});

// Route::livewire('/superadmin/admin', 'admin.employee.index');
