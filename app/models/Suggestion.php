<?php 

/**
* Suggestion
*/
class Suggestion extends Eloquent
{
	
	protected $guarded = [];
	protected $table = 'suggestions';
	
	public function user()
	{
		return $this->belongsTo('User');
	}
}

 ?>