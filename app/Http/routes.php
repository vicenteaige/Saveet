<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//////////
// Home //
//////////
Route::get('/', function () {
    return view('welcome');
});

//////////////////
// v1 API calls //
//////////////////
Route::group(['prefix' => 'v1'], function () {
    /////////////////////////
    // User related calls  //
    /////////////////////////
    Route::group(['prefix' => 'user'], function() {
        Route::post('login', 'UserController@apiLogUser');
        Route::post('register', function() {
           //
        });
    });
    ////////////////////////////////////////////////////////////////
    // Hashtags related calls (requires an authentificated user)  //
    ////////////////////////////////////////////////////////////////
    Route::group(['middleware' => 'auth'], function() {
        Route::resource('tags', '' /* 'TagController' */ );
    });
});
