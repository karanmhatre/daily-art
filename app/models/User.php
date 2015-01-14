<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';
	protected $guarded = [];

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password');

	/**
	 * Get the unique identifier for the user.
	 *
	 * @return mixed
	 */
	public function getAuthIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Get the password for the user.
	 *
	 * @return string
	 */
	public function getAuthPassword()
	{
		return $this->password;
	}

	/**
	 * Get the e-mail address where password reminders are sent.
	 *
	 * @return string
	 */
	public function getReminderEmail()
	{
		return $this->email;
	}

	public function getRememberToken()
	{
	    return $this->remember_token;
	}

	public function setRememberToken($value)
	{
	    $this->remember_token = $value;
	}

	public function getRememberTokenName()
	{
	    return 'remember_token';
	}


	public static function invite($input)
	{
		$check = User::checkUser($input['email']);
		if($check)
		{
			$user = User::create(['name' => $input['name'], 'email' => $input['email']]);
			$user->sendInviteMail($user);
			return true;	
		}
		else
		{
			return false;
		}
		
	}

	public static function checkUser($email)
	{
		$user = User::where('email', $email)->get();
		if(count($user))
			return false;
		else
			return true;
	}

	public function sendInviteMail($user)
	{
		$code = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
		$data['register_code'] = $code;
		$data['theme'] = Theme::today()->theme;
		$data['user']  = $user;
		$user->update(['register_code' => $code]);
		Mail::send('emails.invite', $data, function($message) use ($user){
      $message->to($user['email'], $user['name'])->subject('Welcome to Daily Art!');
    });
	}

	public static function getRegisterUser($token)
	{
		$user = User::where('register_code',$token)->first();
		if($user)
			return $user;
		else
			return false;
	}

	public static function storeUser($input)
	{
		$user = User::where('register_code',$input['register_code'])->first();
		$user->register_code = "";
		$user->name = $input['name'];
		$user->password = Hash::make($input['password']);
		$user->avatar = uploadFile($input['avatar']);
		$user->save();
		Auth::login($user);
		return true;
	}
}
