<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PharmacyManager extends Model
{
    protected $fillable = [
		'drugstore','drugstore_address','license'
	];

	public function userInfo()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function pharmacists()
	{
		return $this->hasMany('App\Pharma', 'manager_id');
	}
}
