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

// new
Route::get('/receipt/delete/{receipt_id}', 'WEB\ReceiptsController@delete')->name('receipt.delete');
Route::get('/receipt/delete/item/{receipt_id}/{item_id}', 'WEB\ReceiptItemsController@delete')->name('receiptsItems.delete');

Route::post('ReceiptsController', 'API\ReceiptsController@updateFromWeb')->name('ReceiptsController.updateFromWeb');
Route::post('ReceiptItemsController', 'API\ReceiptItemsController@addItemToRequest')->name('ReceiptItemsController.addItemToRequest');
Route::post('ReceiptsController2', 'API\ReceiptsController@createReceipt')->name('ReceiptsController.createReceipt');

Route::get('/createRecept', 'WEB\ReceiptsController@create')->name('receipt.createPage');


Route::get('/profile', 'WEB\UserController@index')->name('profile.index');

Route::get('/vendors', 'WEB\VendorsController@index')->name('vendor.index');
Route::get('/vendors/update/{vendor_id}', 'WEB\VendorsController@show')->name('vendor.show');
Route::get('/vendors/delete/{vendor_id}', 'WEB\VendorsController@delete')->name('vendor.delete');
Route::get('/vendors/create', 'WEB\VendorsController@createPage')->name('vendor.createPage');

Route::post('VendorsController', 'API\VendorsController@createUser')->name('VendorsController.createUser');
Route::post('VendorsController2', 'API\VendorsController@updateFromWeb')->name('VendorsController.updateFromWeb');

Route::get('/type', 'WEB\ReceiptTypesController@index')->name('receipt.index');
Route::get('/type/delete/{vendor_id}', 'WEB\ReceiptTypesController@delete')->name('type.delete');
Route::get('/type/create', 'WEB\ReceiptTypesController@createPage')->name('type.createPage');

Route::post('ReceiptTypesController2', 'API\ReceiptTypesController@createType')->name('ReceiptTypesController.createType');
Route::post('ReceiptTypesController', 'API\ReceiptTypesController@updateFromWeb')->name('ReceiptTypesController.updateFromWeb');

