<?php

/**
* Comments
*/
class Notification extends Eloquent
{

  protected $guarded = [];
  protected $table = 'notifications';

  public function user()
  {
    return $this->belongsTo('User');
  }

  public function art()
  {
    return $this->belongsTo('Art');
  }
}

 ?>