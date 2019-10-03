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

Route::view('/', 'frontend.index');

// Login Routes...
Route::post('login', ['as' => 'login.post', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

// Registration Routes...
Route::post('register', ['as' => 'register.post', 'uses' => 'Auth\RegisterController@register']);

// Password Reset Routes...
//Route::get('password/reset', ['as' => 'password.reset', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
//Route::get('password/reset/{token}', ['as' => 'password.reset.token', 'uses' => 'Auth\ResetPasswordController@showResetForm']);
Route::post('password/reset', ['as' => 'password.reset.post', 'uses' => 'Auth\ResetPasswordController@reset']);

Route::get('latest-promotion', 'Frontend\LatestPromotionController@show');

Route::get('refresh-csrf', function () {
   return response()->json(['token' => csrf_token()]);
});

Route::middleware(['auth'])->group(function () {
    Route::get('/me', 'Frontend\AccountController@show');
    Route::put('/me', 'Frontend\AccountController@update');
    Route::get('/banks', 'Frontend\BankController@index');
    Route::get('/faqs', 'Frontend\FaqController@index');
    Route::get('/beneficiaries', 'Frontend\BeneficiaryController@index');
    Route::post('/beneficiaries', 'Frontend\BeneficiaryController@store');
    Route::get('/beneficiaries/{beneficiary}', 'Frontend\BeneficiaryController@show');
    Route::put('/beneficiaries/{beneficiary}', 'Frontend\BeneficiaryController@update');
    Route::delete('/beneficiaries/{beneficiary}', 'Frontend\BeneficiaryController@destroy');
    Route::post('/verification', 'Frontend\VerificationController@store')->middleware('verifiable');
    Route::post('/transactions', 'Frontend\TransactionController@store')->middleware('verified');
    Route::get('/transactions', 'Frontend\TransactionController@index')->middleware('verified');
    Route::get('/transactions/{transaction}', 'Frontend\TransactionController@show');
    Route::post('/transactions/{transaction}/proof', 'Frontend\TransactionProofController@store');
});


// Need for vue router to process routes
Route::view('/{any}', 'frontend.index')
     ->where('any', '^(?!nova|admin.*$).*');
