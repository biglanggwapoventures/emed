<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
	protected $fillable = [
		'specialization','license','clinic','clinic_address','consultation_hours','ptrc'
	];

	public function userInfo()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
