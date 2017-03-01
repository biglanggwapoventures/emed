<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Secretary extends Model
{
   use Illuminate\Database\Eloquent\Model;

 protected $fillable = [
		'attainment'
	];

	public function userInfo()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
