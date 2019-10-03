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

Route::prefix('v1')->group(function () {
    Route::get('/currencies', 'Frontend\Api\CurrencyController@index');
    Route::get('/stores', 'Frontend\Api\StoreController@index');
    Route::get('/fund-sources', 'Frontend\Api\FundSourceController@index');
    Route::get('/transfer-purposes', 'Frontend\Api\TransferPurposeController@index');
    Route::get('/calculate-currency', 'Frontend\Api\CurrencyCalculatorController@index');
});