<?php

class InviteController extends BaseController {

	public function requestInvite()
	{
		$arts = Art::orderBy('created_at', 'DESC')->take(50)->get();

		return View::make('home.invite', compact('arts'));
	}

	public function storeInvite()
	{
		$input = Input::all();
		$invite = Invite::storeInvite($input);
		if($invite)
			return Redirect::to("/")->with('notice','Your Request has been submitted');
		else
			return Redirect::back()->with('message','The email is already in use');

	}
}
