<?php

/**
* ArtController
*/
class ArtController extends BaseController
{

	function show($id)
	{
		$art = Art::with('theme')->find($id);

    $theme = $art->theme->id;

    $prev = Art::where('id', '<>', $art->id)->where('theme_id', '=', $theme)->where('created_at', '<', $art->created_at)->orderBy('created_at', 'DESC')->first();
    $next = Art::where('id', '<>', $art->id)->where('theme_id', '=', $theme)->where('created_at', '>', $art->created_at)->orderBy('created_at')->first();

		return View::make('home.single', compact('art', 'prev', 'next'));
	}
}

 ?>