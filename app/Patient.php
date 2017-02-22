<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
	protected $fillable = [
		'address'
	];

	public function userInfo()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
