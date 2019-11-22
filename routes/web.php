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

// including '/register' and '/login'
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/receipt', 'WEB\ReceiptsController@index')->name('receipt.index');
Route::get('/receipt/{receipt_id}', 'WEB\ReceiptsController@show')->name('receipt.show');
