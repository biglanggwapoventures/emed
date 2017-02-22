<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmacyManager extends Model
{
    protected $fillable = [
		'drugstore'
	];

	public function userInfo()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
