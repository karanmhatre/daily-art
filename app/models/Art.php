<?php

use Imagine\Image\Box;
use Imagine\Image\ImageInterface;

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

	public function like_users()
	{
		return $this->hasMany('LikeUser');
	}

	public function comments()
	{
		return $this->hasMany('Comment');
	}

	public static function today()
	{
		// $today_date = date('H') < 3 ? date('Y-m-d', strtotime('-1 day')) : date('Y-m-d');
		$art = Theme::today()->art()->where('arts.user_id', '=', Auth::user()->id)->first();
		// $art = Art::whereUserId(Auth::user()->id)->where('created_at', '>=', $today_date)->first();
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

	public static function resizeImage($path)
	{
    $image = Imagine::open(public_path() . '/' . $path);
    $image = $image->resize($image->getSize()->widen(700));

    $destination = public_path() . '/' . $path;

    $image->save($destination);
	}
}
