<?php

use Illuminate\Http\Request;


/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/


Route::prefix('users')->group(function () {
    Route::get('/', 'UserController@index')->name('users');
    Route::get('/{id}', 'UserController@show')->name('showUser');
    Route::post('/create', 'UserController@store')->name('createUser');
});

Route::prefix('loans')->group(function () {
    Route::get('/', 'LoanController@index')->name('loans');
    Route::get('/{id}', 'LoanController@show')->name('showLoan');
    Route::post('/create', 'LoanController@store')->name('createLoan');
});

Route::prefix('repayments')->group(function () {
    Route::get('/{id}', 'RepaymentController@show')->name('showRepayment');
    Route::post('/create', 'RepaymentController@store')->name('createRepayment');
});