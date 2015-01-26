<?php

/**
* ArtController
*/
class ArtController extends BaseController
{

	public function show($id)
	{
		$art = Art::with('theme')->with('user')->with('like_users')->with('comments')->find($id);

    $theme = $art->theme->id;

    if(Auth::check())
      $like_user = LikeUser::where('user_id', '=', Auth::user()->id)->where('art_id', '=', $id)->first();
    else
      $like_user = null;

    $liked = !is_null($like_user);

    $prev = Art::where('id', '<>', $art->id)->where('theme_id', '=', $theme)->where('created_at', '<', $art->created_at)->orderBy('created_at', 'DESC')->first();
    $next = Art::where('id', '<>', $art->id)->where('theme_id', '=', $theme)->where('created_at', '>', $art->created_at)->orderBy('created_at')->first();

		return View::make('home.single', compact('art', 'prev', 'next', 'liked'));
	}

  public function like()
  {
    $id = Input::get('id');

    LikeUser::create(['user_id' => Auth::user()->id, 'art_id' => $id]);

    $art = Art::find($id);
    $art->likes = $art->likes + 1;
    $art->save();

    return "true";
  }

  public function unlike()
  {
    $id = Input::get('id');

    LikeUser::where('user_id', '=', Auth::user()->id)->where('art_id', '=', $id)->first()->delete();

    $art = Art::find($id);
    $art->likes = $art->likes - 1;
    $art->save();

    return "true";
  }

  public function comment()
  {
    $id = Input::get('id');
    $body = Input::get('body');

    $comment = Comment::create([
      'art_id' => $id,
      'user_id' => Auth::user()->id,
      'body' => $body
    ]);

    $art = Art::find($id);

    return View::make('layouts.comment')->with(compact('comment', 'art'));
  }

  public function comment_mobile()
  {
    $id = Input::get('id');
    $body = Input::get('body');

    $comment = Comment::create([
      'art_id' => $id,
      'user_id' => Auth::user()->id,
      'body' => $body
    ]);

    $art = Art::find($id);

    $layout = '<li><a href="' . URL::route("user.profile", [$comment->user->id, Str::slug($comment->user->name)]) . '">' . $comment->user->name . '</a> - ' . $comment->body . '</li>';

    return $layout;
  }
}

 ?>