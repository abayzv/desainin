<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompaniesController;
use App\Http\Controllers\EmployeesController;

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
    return view('index');
});

Route::middleware(['auth'])->group(function(){

  Route::get('/dashboard', function () {
    return view('dashboard');
  })->name('dashboard');

  Route::resource('/companies', CompaniesController::class);

  Route::resource('/employees', EmployeesController::class);

});

require __DIR__.'/auth.php';

