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

	public function artworks(){
		return $this->hasMany('Art');
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
	public function getDaysBunked($user)
	{
		$submitted = $user->getDaysSubmitted($user);
		$theme = Theme::oldCount();
		return ($theme - $submitted);
	}

	public function getDaysSubmitted($user)
	{
		return count($user->artworks);
	}

	public static function resetPassword($input)
	{
		$user = User::where('email', $input['email'])->first();
		if(!is_null($user)){
			$reset_code = bin2hex(mcrypt_create_iv(22, MCRYPT_DEV_URANDOM));
			$data['reset_code'] = $reset_code;
			$user->update(['forgot_token' => $reset_code]);
			$data['name'] = $user->name;
			$data['email'] = $user->email;
			Mail::send('emails.reset', $data, function($message) use ($user){
	      $message->to($user['email'], $user['name'])->subject('Password Reset Request');
	    });
	    return true;
	  }
	  else
	  	return false;
	}
	public static function checkResetPasswordToken($token)
	{
		$user = User::where('forgot_token', $token)->first();
		if(!is_null($user))
			return true;
		else
			return false;
	}
	public static function saveResetPassword($input)
	{
		$user = User::where('forgot_token', $input['token'])->first();
		if(!is_null($user) && $input['password'] == $input['confirm_password'])
		{
			$user->update(['forgot_token' => "", 'password' => Hash::make($input['password'])]);
			return true;
		}
		else
			return false;
	}

	public function updateUser($input)
	{
		if($input['name'] != "")
			$this->update(['name' => $input['name']]);
		if($input['password'] != "")
			$this->update(['password' => Hash::make($input['password'])]);
		if(!is_null($input['avatar']))
			$this->update(['avatar' => uploadFile(Input::file('avatar'))]);
		return true;
	}
}
