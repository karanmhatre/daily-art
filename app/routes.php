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

Route::get('login', 'HomeController@login');
Route::post('login', array('as' => 'login' ,'uses' => 'HomeController@do_login'));
// REGISTER
Route::get('/users/register/{token}', array('uses' => 'HomeController@getRegisterUser', 'as' => 'user.register'));
Route::post('/users/store', array('uses' => 'HomeController@storeUser', 'as' => 'user.store'));
// INVITE
Route::get('/request/invite', array('uses' => 'InviteController@requestInvite', 'as' => 'user.requestInvite'));
Route::post('/request/invite', array('uses' => 'InviteController@storeInvite', 'as' => 'user.storeInvite'));

Route::get('art/{id}', array('uses' => 'ArtController@show', 'as' => 'art.show'));
Route::get('users/{id}/{slug?}', array('uses' => 'UserController@show', 'as' => 'user.profile'));

// LOGGED IN USER ACTIONS
Route::group(array('before' => 'auth'), function() {
	Route::get('user', 'UserController@index');
	Route::get('logout', 'HomeController@logout');
	Route::post('user/upload' , array('as' => 'user.upload', 'uses' => 'UserController@upload'));
	Route::get('user/change/{id}' , array('as' => 'user.change', 'uses' => 'UserController@change'));
});

Route::group(array('prefix' => 'admin', 'before' => 'admin.auth'), function(){
	Route::get('/', array('uses' => 'AdminController@invitePage', 'as' => 'get.user.invite'));
	Route::post('user/invite', array('uses' => 'AdminController@inviteUser', 'as' => 'store.user.invite'));
});
