<?php 

/**
* ArchivesController
*/
class ArchivesController extends BaseController
{
	
	public function index()
	{
		$months = Art::getArtMonthWise();
		return View::make('archives.index', compact('months'));
	}

	public function show($month, $year)
	{
		$themes = Art::getMonthArt($month, $year);
		return View::make('archives.show', compact('themes'));
	}
}


 ?>