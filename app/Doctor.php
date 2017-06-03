<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Doctor extends Model
{
	protected $fillable = [
		'specialization','clinic','clinic_address','clinic_start','clinic_end','ptr','prc','s2','title','subspecialty','med_school','med_school_year','residency','residency_year','training','training_year','affiliations',
		'specialization_id'
	];

	protected $casts = [
		'affiliations' => "array",
		'subspecialty' => "array"
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
		 return $this->hasMany('App\Secretary', 'doctor_id');
	}

	public function consultations()
	{
		return $this->hasMany('App\MedicalHistory', 'doctor_id');
	}

	public function prescriptions()
	{
		return $this->hasMany('App\Prescription', 'doctor_id');
	}

	public function subspecializations()
	{
		return $this->belongsToMany('App\Subspecialization', 'doctor_subspecializations', 'doctor_id', 'subspecialization_id');
	}

	public function specializations()
	{
		return $this->belongsToMany('App\Specialization', 'doctor_specialization', 'doctor_id', 'specialization_id')->withPivot('subspecialization_ids');
	}

	public function organizations()
	{
		return $this->belongsToMany('App\Organizations', 'doctor_organizations', 'doctor_id', 'organization_id');
	}

	public function affiliations()
	{
		return $this->belongsToMany('App\Affiliations', 'doctor_affiliations', 'doctor_id', 'affiliation_id')
			->withPivot('affiliation_branch_id', 'clinic_start', 'clinic_end')
			->withTimestamps();
	}

	public function specialization()
	{
		return $this->belongsTo('App\Specialization', 'specialization_id');
	}


	public static function getPRCNo($user_id)
	{
		return DB::table('doctors')->where('user_id', $user_id)->first()->prc;
	}

	public static function getPTRNo($user_id)
	{
		return DB::table('doctors')->where('user_id', $user_id)->first()->ptr;
	}

	public static function getS2No($user_id)
	{
		return DB::table('doctors')->where('user_id', $user_id)->first()->s2;
	}
}
