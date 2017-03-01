<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pharma extends Model
{
      protected $fillable = [
		'drugstore','drugstore_address','license'
	];

	public function userInfo()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
}
