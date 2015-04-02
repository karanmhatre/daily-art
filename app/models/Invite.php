<?php

class Invite extends Eloquent {
	public $guarded = array();
	public $table = 'invite';
	

	public static function storeInvite($input)
	{
		$user = User::checkUser($input['email']);
		if($user)
		{
			$inviteStatus = Invite::checkInvite($input['email']);
			if($inviteStatus)
				{
					$invite = Invite::create(['name' => $input['name'], 'email' => $input['email']]);	
					$data['name'] = $invite->name;
					Mail::send('emails.request', $data, function($message) use ($invite){
			      $message->to($invite['email'], $invite['name'])->subject('Invite Request Submitted!');
			    });					
				}
			return true;
		}
		else
			return false;
		
	}

	public static function checkInvite($email)
	{
		$invite = Invite::where('email', $email)->first();
		if(count($invite))
			return false;
		else
			return true;
	}

	public function invited()
	{
		$invited = User::checkUser($this->email);
		if(!$invited)
			return "<i class='fa fa-check'></i>";
		else
			return "<a href=".URL::route('admin.invite.direct', $this->id) ." class='pure-button'>Invite</a>";

	}
}
