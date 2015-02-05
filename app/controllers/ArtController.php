<?php

/**
* ArtController
*/
class ArtController extends BaseController
{

	public function show($id)
	{

    $from_notification = Input::get('n');

    if($from_notification == 1)
      Notification::where('art_id' , '=', $id)->update(['read' => '1']);

		$art = Art::with('theme')->with('user')->with('like_users')->with('comments')->find($id);
    $theme = $art->theme->id;

    $post_liked_by_users = User::whereIn('id', $art->like_users()->lists('user_id'))->get();

    $post_liked_by_users_liked = [];

    foreach ($post_liked_by_users as $liked_user) {
      $post_liked_by_users_liked[] = '<a href="' . URL::route("user.profile", [$liked_user->id, Str::slug($liked_user->name)]) . '">' . $liked_user->name. '</a>';
    }

    $post_liked_by_users_liked = implode($post_liked_by_users_liked, ',');

    if(Auth::check())
      $like_user = LikeUser::where('user_id', '=', Auth::user()->id)->where('art_id', '=', $id)->first();
    else
      $like_user = null;

    $liked = !is_null($like_user);

    $prev = Art::where('id', '<>', $art->id)->where('theme_id', '=', $theme)->where('created_at', '<', $art->created_at)->orderBy('created_at', 'DESC')->first();
    $next = Art::where('id', '<>', $art->id)->where('theme_id', '=', $theme)->where('created_at', '>', $art->created_at)->orderBy('created_at')->first();

		return View::make('home.single', compact('art', 'prev', 'next', 'liked', 'post_liked_by_users_liked'));
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

    if($art->user_id != Auth::user()->id)
    {
      Notification::create([
        'art_id' => $id,
        'user_id' => $art->user_id,
      ]);
    }

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