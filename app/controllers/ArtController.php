<?php 

/**
* ArtController
*/
class ArtController extends BaseController
{
	
	function show($id)
	{
		$art = Art::with('theme')->find($id);
		return View::make('home.single', compact('art'));
	}
}

 ?>