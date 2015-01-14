<?php

class AdminController extends BaseController {

	public function invitePage()
	{
		return View::make('admin.invite.index');
	}

	public function inviteUser()
	{
		$input = Input::all();
		$user = User::invite($input);
		if($user)
			return Redirect::back()->with('notice','Successfully sent the invite');
		else
			return Redirect::back()->with('warning','The Email is already in use');
	}

}
