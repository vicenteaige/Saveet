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

Route::group(['middleware' => 'auth'], function() {
    Route::get('/', function () {
        return view('index');
    });
    Route::get('home', function(){
        return view('index');
    });
});

//Register
Route::get('register', function(){
    return view('auth/register');
});

//Login
Route::get('login', function(){
    return view('auth/login');
});

Route::get('password/email', function(){
    return view('auth/password');
});

Route::get('password/reset/{token}', function() {
    return view('auth/reset');
});

// Authentication routes...
Route::get('login', 'Auth\AuthController@getLogin');
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');
Route::get('activate/{token}', 'ActivateController@getActivateView');

//////////////////
// v1 API calls //
//////////////////
Route::group(['prefix' => 'v1'], function () {
    /////////////////////////
    // User related calls  //
    /////////////////////////
    Route::group(['prefix' => 'user'], function() {
        Route::get('', 'UserController@apiGetLoggedUser');
        Route::post('login', 'UserController@apiLogUser');
        Route::get('logout', 'UserController@apiLogoutUser');

        Route::post('password/reset', 'Auth\PasswordController@store');
        Route::post('password/email', 'Auth\PasswordController@apiResetPassword');

        Route::resource('register', 'UserController');

    });
    ////////////////////////////////////////////////////////////////
    // Hashtags related calls (requires an authentificated user)  //
    ////////////////////////////////////////////////////////////////
    Route::resource('tag','TagController');
    Route::delete('tag/{id}','TagController@destroy');


    Route::group(['prefix' => 'twitter'], function() {
        Route::get('/trends', 'TwitterController@getTrends');
        Route::get('/daemon', 'TwitterController@daemonServiceTrends');
    });

    Route::group(['prefix' => 'daemon'], function() {
        Route::get('/update', 'DaemonController@updateTrends');
        Route::get('/stop', 'DaemonController@stopDaemon');
    });


    // User activation
    Route::post('/activate', 'ActivateController@store');

    Route::group(['prefix' => 'es'], function() {
        Route::get('/test', 'ElasticController@testEs');
    });


});



