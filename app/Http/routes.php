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

Route::resource('v1/tag','TagController');

 Route::get('tags', function () {
     return view('tags');
 });


//////////
// Home //
//////////

Route::get('/', function () {
    return view('index');
});

//Register
Route::get('register', function(){
    return view('auth/register');
});

//Login
Route::get('login', function(){
    return view('auth/login');
});

//Route::get('/iscorrect','UserController@AuthAndLog');

Route::group(['middleware' => 'auth'], function() {
    Route::get('home', function(){
        return view('index');
    });
});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

//////////////////
// v1 API calls //
//////////////////
Route::group(['prefix' => 'v1'], function () {
    /////////////////////////
    // User related calls  //
    /////////////////////////
    Route::group(['prefix' => 'user'], function() {
        Route::post('login', 'UserController@apiLogUser');
        Route::get('logout', 'UserController@apiLogoutUser');
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

    Route::group(['prefix' => 'twitter'], function() {
        Route::get('/worldtrends', 'TwitterController@getWorldTrends');
    });



});

