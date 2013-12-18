<?php

class HomeController extends BaseController {

	/*
	|--------------------------------------------------------------------------
	| Default Home Controller
	|--------------------------------------------------------------------------
	|
	| You may wish to use controllers instead of, or in addition to, Closure
	| based routes. That's great! Here is an example controller method to
	| get you started. To route to this controller, just add the route:
	|
	|	Route::get('/', 'HomeController@showWelcome');
	|
	*/

	public function index()
	{
		$themes = Theme::with('art')->with('art.user')->orderBy('date', 'DESC')->get();
		return View::make('home.index')->with(compact('themes'));
	}

	public function login()
	{
		return View::make('home.login');
	}

	public function do_login()
	{
		if(Auth::attempt(Input::except('_token')))
			return Redirect::to('user');
		else
			return Redirect::back()->withInput()->with('message','Invalid credentials');
	}

	public function logout()
	{
		Auth::logout();
		return Redirect::to('/');
	}

}