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
Route::get('/test', 'UserController@check');
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


// Creating user records for suppliers protocol
// PROTOCOL CODE: XAXIS
Route::get('/XAXIS/update-usercategories', 'HamsUserController@insert_supplier_record_into_usercategory_table');
Route::get('/XAXIS/update-usergrades', 'HamsUserController@insert_contractor_record_into_usergrade_table');
Route::get('/XAXIS/execute', 'HamsUserController@make_users_from_suppliers');

// Create User from Supplier
Route::get('/supplier/add', 'HamsUserController@create')->middleware('auth', 'user.isAdmin')->name('add-supplier-page');
Route::get('/supplier/add-form/{supplierId}', 'HamsUserController@createForm')->middleware('auth')->name('register-supplier-form');
Route::post('/supplier/add', 'HamsUserController@store')->middleware('auth', 'user.isAdmin')->name('add-supplier');