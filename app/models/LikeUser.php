<?php

class LikeUser extends Eloquent {
  public $guarded = array();

  public $table = 'like_user';

  public function user()
  {
    return $this->belongsTo('User');
  }

  public function art()
  {
    return $this->belongsTo('Art');
  }

}
