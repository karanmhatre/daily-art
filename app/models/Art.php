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

	public static function getArtMonthWise()
	{
		$months = Art::all()->groupBy(function($date) {
    	return \Carbon\Carbon::parse($date->created_at)->format('Y-m');
  	});
  	return $months;
	}

	public static function getMonthArt($month, $year)
	{
		$startDate = \Carbon\Carbon::create($year, $month, 01);
		$endDate = \Carbon\Carbon::create($year, $month, $startDate->daysInMonth);
		$themes = Theme::with(['art', 'art.user'])->where('date', '>=', $startDate)->where('date', '<=', $endDate)->where('date', '<=', \Carbon\Carbon::today())->paginate(4);
		return $themes;
	}
}
