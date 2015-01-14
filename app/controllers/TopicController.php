<?php 

/**
* TopicController
*/
class TopicController extends BaseController
{
	
	public function index()
	{
		$topics = Theme::orderBy('id','desc')->get();
		return View::make('admin.topics.index', compact('topics'));
	}

	public function store()
	{
		$input = Input::all();
		Theme::create(['theme' => $input['name'], 'date' => $input['date']]);
		return Redirect::back()->with('notice', "Added new topic");
	}
}

 ?>