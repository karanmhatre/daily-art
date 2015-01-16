<?php

class AdminController extends BaseController {

	public function invitePage()
	{
		$invites = Invite::all();
		return View::make('admin.invite.index', compact('invites'));
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
