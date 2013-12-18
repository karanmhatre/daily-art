<?php

class Theme extends Eloquent {
	public $guarded = array();

	public function art()
	{
		return $this->hasMany('Art');
	}

	public static function today()
	{
		$theme = Theme::where('date', '>=', date('Y-m-d'))->where('date', '<=', date('Y-m-d', strtotime("+1 day", strtotime(date('Y-m-d')))))->first();
		return $theme;
	}
}
