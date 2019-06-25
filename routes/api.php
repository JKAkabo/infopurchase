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

/*
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::get('/v1/stocked-items', 'ApiController@getStockedItem');

Route::get('/v1/stocked-items/{itemid}', 'ApiController@getOneStockedItem');

Route::post('/v1/stocked-items/{itemid}', 'ApiController@updateStockedItem');

//PO
Route::get('/v1/pending-receival', 'ApiController@getAllApprovalPendingReceival');

Route::get('/v2/pending-receival/{supplierid}', 'ApiController@getAllApprovalPendingReceivalBySupplierID');

Route::get('/v1/pending-receival/{purchaseorderno}', 'ApiController@getOneApprovalPendingReceival');
Route::get('/v2/pending-receival/{purchaseorderno}', 'ApiController@getOneApprovalPendingReceivalV2');

Route::post('/v1/pending-receival/{purchaseorderno}', 'ApiController@updateApprovalPendingReceival');

Route::post('/v1/save-stored/{purchaseorderno}/{itemid}', 'ApiController@saveAllCompletedPurchaseOrder');

//Stocked temp for check
//Get Waiting to be checked
Route::get('/v1/pending-check/{purchaseorderno}', 'ApiController@getAllReceivalPending');
//Save QR Code
Route::post('/v1/save-qr-code', 'ApiController@storeQR');

Route::get('/v1/received-orders', 'ApiController@getAllReceivedOrder');
Route::get('/v1/received-orders/{orderno}', 'ApiController@getOneReceivedOrder');

Route::get('/v2/save-receive-orders/{orderId}/{itemid}', 'ApiController@saveReceivedOrder');





