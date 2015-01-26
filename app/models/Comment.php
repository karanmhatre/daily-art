<?php

/**
* Comments
*/
class Comment extends Eloquent
{

  protected $guarded = [];
  protected $table = 'comments';

  public function user()
  {
    return $this->belongsTo('User');
  }

  public function art()
  {
    return $this->belongsTo('art');
  }
}

 ?>