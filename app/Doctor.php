<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
	protected $fillable = [
		'specialization','clinic','clinic_address','clinic_hours','ptr','prc','s2','title','subspecialty','med_school','med_school_year','residency','residency_year','training','training_year','affiliations'
	];

	public function userInfo()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function patients()
	{
		return $this->belongsToMany('App\Patient', 'doctor_patient', 'doctor_id', 'patient_id');
	}

	public function secretaries()
	{
		 return $this->hasMany('App\Secretary', 'id');
	}
}
