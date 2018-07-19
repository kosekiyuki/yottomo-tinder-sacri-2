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

Route::get('/', 'MemosController@index');

// user registration
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup.get');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// Login authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::get('logout', 'Auth\LoginController@logout')->name('logout.get');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('users', 'UsersController', ['only' => ['index', 'show','edit']]);
    
    Route::resource('profiles', 'ProfilesController');
    
    Route::group(['prefix' => 'users/{id}'], function () {
        // like
        Route::post('friend', 'UserFriendController@friend')->name('user.friend');
        Route::delete('unfriend', 'UserFriendController@unfriend')->name('user.unfriend');
        Route::get('friends', 'UsersController@friends')->name('users.friends');
        
        // zuttomo
        Route::post('zuttomo', 'UserFriendController@zuttomo')->name('user.zuttomo');
        Route::delete('unzuttomo', 'UserFriendController@unzuttomo')->name('user.unzuttomo');
        Route::get('zuttomoings', 'UsersController@zuttomoings')->name('users.zuttomoings');
        
        // future
        Route::post('future', 'UserFriendController@future')->name('user.future');
        Route::get('futures', 'UsersController@futures')->name('users.futures');
        
        Route::get('futures2', 'UsersController@futures2')->name('users.futures2');
        
    });
    
    Route::resource('memos', 'MemosController', ['only' => ['store', 'destroy']]);
});

