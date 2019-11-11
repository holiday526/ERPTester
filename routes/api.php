<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware'=>'auth:api'], function() {
   // later put all the apiResource into this bracket
});

Route::apiResource('vendor', 'API\VendorsController');
Route::apiResource('receipt/type', 'API\ReceiptTypesController')->except(['show']);
Route::apiResource('receipt', 'API\ReceiptsController')->except(['store', 'update']);
Route::apiResource('receipt/item', 'API\ReceiptItemsController')->except(['index', 'store', 'update', 'show']);
// for debugging
Route::get('receipt/item/index', 'API\ReceiptItemsController@index');

Route::group(['middleware' => ['json']], function () {
    Route::post('receipt/item', 'API\ReceiptItemsController@store');
    Route::put('receipt/item', 'API\ReceiptItemsController@update');

    Route::post('receipt', 'API\ReceiptsController@store');
    Route::put('receipt', 'API\ReceiptsController@update');
});

Route::post('login', 'API\UserController@login');
Route::post('register', 'API\UserController@register');
Route::group(['middleware' => 'auth:api'], function() {
    Route::post('details', 'API\UserController@details');
});
