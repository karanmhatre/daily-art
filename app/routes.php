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
Route::get('forgot_password', array('uses' => 'UserController@forgotPassword', 'as' => 'forgot_password'));
Route::post('reset_password', array('uses' => 'UserController@resetPassword', 'as' => 'reset_password'));
Route::get('reset_password/{token}', array('uses' => 'UserController@doResetPassword', 'as' => 'do_reset_password'));
Route::post('reset_password/new/password', array('uses' => 'UserController@saveResetPassword', 'as' => 'save_reset_password'));
// REGISTER
Route::get('/users/register/{token}', array('uses' => 'HomeController@getRegisterUser', 'as' => 'user.register'));
Route::post('/users/store', array('uses' => 'HomeController@storeUser', 'as' => 'user.store'));
// INVITE
Route::get('/request/invite', array('uses' => 'InviteController@requestInvite', 'as' => 'user.requestInvite'));
Route::post('/request/invite', array('uses' => 'InviteController@storeInvite', 'as' => 'user.storeInvite'));

// SINGLE ART PAGE
Route::get('art/{id}', array('uses' => 'ArtController@show', 'as' => 'art.show'));
// PUBLIC PROFILE
Route::get('users/{id}/{slug?}', array('uses' => 'UserController@show', 'as' => 'user.profile'));
// ARCHIVES PER MONTH
Route::get('archives', array('uses' => 'ArchivesController@index', 'as' => 'archives.index'));
Route::get('archives/{year}/{month}', array('uses' => 'ArchivesController@show', 'as' => 'archives.show'));

// LOGGED IN USER ACTIONS
Route::group(array('before' => 'auth'), function() {
	Route::get('user', 'UserController@index');
	Route::get('logout', 'HomeController@logout');
	Route::post('user/upload' , array('as' => 'user.upload', 'uses' => 'UserController@upload'));

	Route::post('updateCaption', array('as' => 'updateCaption', 'uses' => 'UserController@updateCaption'));

	Route::get('user/change/{id}' , array('as' => 'user.change', 'uses' => 'UserController@change'));
	Route::get('user/edit/profile/{id}', array('uses' => 'UserController@profileEdit', 'as' => 'users.edit.profile'));
	Route::post('users/update/{id}', array('uses' => 'UserController@update', 'as' => 'user.update'));
	Route::get('suggestions', array('uses' => 'SuggestionsController@create', 'as' => 'suggestions.new'));
	Route::post('suggestions', array('uses' => 'SuggestionsController@store', 'as' => 'suggestions.store'));

	Route::post('like', array('as' => 'like', 'uses' => 'ArtController@like'));

	Route::post('comment', array('as' => 'comment', 'uses' => 'ArtController@comment'));

	Route::post('comment_mobile', array('as' => 'comment_mobile', 'uses' => 'ArtController@comment_mobile'));

	Route::post('unlike', array('as' => 'unlike', 'uses' => 'ArtController@unlike'));
});

Route::group(array('prefix' => 'admin', 'before' => 'admin.auth'), function(){
	Route::get('/', array('uses' => 'AdminController@invitePage', 'as' => 'get.user.invite'));
	Route::post('user/invite', array('uses' => 'AdminController@inviteUser', 'as' => 'store.user.invite'));
	Route::get('user/invite/{id}', array('uses' => 'AdminController@directInvite', 'as' => 'admin.invite.direct'));
	Route::get('topics', array('uses' => 'TopicController@index', 'as' => 'topics.index'));
	Route::post('topics', array('uses' => 'TopicController@store', 'as' => 'topics.store'));
	Route::get('suggestions', array('uses' => 'SuggestionsController@index', 'as' => 'suggestions.index'));
	Route::post('suggestion/{id}', array('uses' => 'SuggestionsController@delete', 'as' => 'suggestions.delete'));
});

View::composer('layouts.master', function($view)
{
	if(Auth::check())
		$notifications = Notification::whereUserId(Auth::user()->id)->whereRead('0')->get();
	else
		$notifications = null;

	$view->with('notifications', $notifications);
});
