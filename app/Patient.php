<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
	protected $fillable = [
		'enumber','bloodtype','erelationship','econtact','nationality','civilstatus'
	];

	public function userInfo()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
