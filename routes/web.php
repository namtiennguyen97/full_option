<?php

use Illuminate\Support\Facades\Route;

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

Route::group(['prefix'=>'customer'], function (){
    Route::get('/',[\App\Http\Controllers\CustomerController::class,'index'])->name('customer.index');
    Route::post('/create',[\App\Http\Controllers\CustomerController::class,'store'])->name('customer.create');
    Route::get('/searching',[\App\Http\Controllers\CustomerController::class,'searching'])->name('customer.searching');
    Route::get('/destroy/{id}',[\App\Http\Controllers\CustomerController::class,'destroy'])->name('customer.destroy');
});
