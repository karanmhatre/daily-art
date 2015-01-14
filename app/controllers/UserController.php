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
		$arts = $user->artworks->lists('id');
		$arts = Art::whereIn('id', $arts)->get();
		return View::make('users.profile')->with(compact('arts','user'));
	}
}