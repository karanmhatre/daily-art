<?php

/**
* SuggestionControlelr
*/
class SuggestionsController extends BaseController
{

	public function index()
	{
		$suggestions =  Suggestion::get();
		return View::make('admin.suggestions.index', compact('suggestions'));
	}

	public function delete($id)
	{
		Suggestion::destroy($id);
		return Redirect::back()->with('notice', 'Deleted the Suggestion!');
	}

	public function create()
	{
		$themes = Theme::get();
		return View::make('suggestions.new', compact('themes'));
	}

	public function store()
	{
		$input = Input::all();
		if(!empty($input['topic']))
		{
			$theme = Theme::where('theme', $input['topic'])->first();
			if(!$theme){
				Suggestion::create(['user_id' => Auth::user()->id, 'topic' => $input['topic']]);
				return Redirect::to('/')->with('notice', 'Your suggestion has been submitted. Thank you!');
			}else{
				return Redirect::back()->with('notice','The topic has already been featured');
			}
		}
		else{
			return Redirect::back()->with('notice', "Please give a suggestion that isn't so abstract");
		}

	}

}

 ?>