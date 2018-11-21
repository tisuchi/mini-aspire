<?php

use Illuminate\Http\Request;


/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::resource('users', 'UserController')->only([
    'index', 'show', 'create'
]);

Route::prefix('users')->group(function () {
    Route::get('/', 'UserController@index')->name('users');
    Route::get('/{id}', 'UserController@show')->name('showUser');
    Route::post('/create', 'UserController@store')->name('createUser');
    
});