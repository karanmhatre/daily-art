<?php

class UserController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		$art_today = Art::today();
		return View::make('users.index')->with(compact('art_today'));
	}

	public function upload()
	{
		$art = new Art();
		$art->theme_id = Theme::today()->id;
		$art->user_id = Auth::user()->id;
		$art->image = uploadFile(Input::file('file'));
		$art->save();

		return "true";
	}

	public function change($id)
	{
		$art = Art::find($id);

		if($art->user_id == Auth::user()->id)
			Art::find($id)->delete();

		return Redirect::back();
	}

	public function show($id)
	{
		$user = User::find($id);
		$arts = $user->artworks;
		$arts_array = $user->artworks->toArray();
		$count = count($arts_array) < 3 ? count($arts_array) : 3;
		$random = array_rand($arts_array, count($arts_array));
		return View::make('users.profile')->with(compact('arts','user', 'random', 'arts_array'));
	}

	public function forgotPassword()
	{
		return View::make('users.forgot_password');
	}

	public function resetPassword()
	{
		$input = Input::all();
		$notice = User::resetPassword($input);
		if($notice)
			return Redirect::to('/')->with('notice','A password reset link has been sent to your mail');
		else
			return Redirect::back()->with('warning','The email was incorrect');
	}

	public function doResetPassword($token)
	{
		$user = User::checkResetPasswordToken($token);
		$reset_code = $token;
		if($user)
			return View::make('users.passwordReset', compact('reset_code'));
		else
			return Redirect::to('/')->with('notice','Invalid password reset url');
	}

	public function saveResetPassword()
	{
		$input = Input::all();
		$user = User::saveResetPassword($input);
		if($user)
			return Redirect::to('login')->with('notice','Password was reset successfully');
		else
			return Redirect::back()->with('notice','Password didn\'t match');
	}

	public function profileEdit($id)
	{
		if($id == Auth::user()->id)
		{
			$user = User::find($id);
			$theme = Theme::today()->theme;
			return View::make('users.settings', compact('user','theme'));
		}
		return Redirect::to("/");
	}

	public function update($id)
	{
		$user = User::find($id);
		$input = Input::all();
		$result = $user->updateUser($input);
		if($result)
			return Redirect::back()->with('notice','Updated the profile');
		else
			return Redirect::back()->with('notice','There was some problem in update');
	}
}