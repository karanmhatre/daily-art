<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('test', function() {
	View::make('home.test');
});

Route::get('login', 'HomeController@login');
Route::post('login', array('as' => 'login' ,'uses' => 'HomeController@do_login'));

Route::group(array('before' => 'auth'), function() {
	Route::get('user', 'UserController@index');
	Route::get('logout', 'HomeController@logout');
	Route::post('user/upload' , array('as' => 'user.upload', 'uses' => 'UserController@upload'));
	Route::get('user/change/{id}' , array('as' => 'user.change', 'uses' => 'UserController@change'));
});