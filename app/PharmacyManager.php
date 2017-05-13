<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class PharmacyManager extends Model
{
    protected $fillable = [
		'drugstore','drugstore_branch','license'
	];

	public function userInfo()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function pharmacists()
	{
		return $this->hasMany('App\Pharma', 'manager_id');
	}

	public static function getManagerData($user_id)
	{
		return DB::table('pharmacy_managers')->where('user_id', $user_id)->first();
	}
}
