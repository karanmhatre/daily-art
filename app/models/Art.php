<?php

class Art extends Eloquent {
	public $guarded = array();

	public function user()
	{
		return $this->belongsTo('User');
	}

	public function theme()
	{
		return $this->belongsTo('Theme');
	}

	public static function today()
	{
		$art = Art::whereUserId(Auth::user()->id)->where('created_at', '>=', date('Y-m-d'))->where('created_at', '<=', date('Y-m-d', strtotime("+1 day", strtotime(date('Y-m-d')))))->first();
		return $art;
	}
}
