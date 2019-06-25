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

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/register-users', 'UserController@store')->name('register.user');

Route::get('/user-types', 'UserController@get_user_type')->name('user-types');

Route::get('/qr-codes', 'QRCodeController@index')->name('qr-codes');
Route::get('/qr-codes-list', 'QRCodeController@list')->name('qr-codes-list');

Route::get('/stock-movements', 'HomeController@getStockMovement')->name('stock-movement');

Route::get('/stock-movements/{itemid}', 'HomeController@getOneStockMovement')->name('stock-movement-item');

Route::get('/stock-items-views', 'HomeController@getStockMovementView')->name('stock-items');

Route::get('/stock-items-views/{itemid}/{storeid}', 'HomeController@getOneStockMovementView')->name('stock-items-item');

//Orders
Route::get('/orders-pending', 'PurchaseOrderLinesApprovedPendingReceivalViewController@index')->name('orders-pending');