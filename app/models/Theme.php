<?php

class Theme extends Eloquent {
	public $guarded = array();

	public function art()
	{
		return $this->hasMany('Art');
	}

	public static function today()
	{
		$today_date = date('H') < 3 ? date('Y-m-d', strtotime('-1 day')) : date('Y-m-d');
		$theme = Theme::where('date', '=', $today_date)->first();
		return $theme;
	}

	public static function oldCount($date)
	{
		if(empty($date))
		{
			$date = \Carbon\Carbon::today();
			$theme = Theme::where('date', '<=', \Carbon\Carbon::today())->get();
		}else
			$theme = Theme::where('date', '<=', \Carbon\Carbon::today())->where('date', '>=', $date)->get();
		return count($theme);
	}
}
