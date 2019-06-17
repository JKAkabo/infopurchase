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

Route::get('/v1/pending-receival/{purchaseorderno}', 'ApiController@getOneApprovalPendingReceival');

Route::post('/v1/stocked-items/{purchaseorderno}', 'ApiController@updateAllApprovalPendingReceival');



