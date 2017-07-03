<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

use EMedHelper, Log;

class Patient extends Model
{
	protected $fillable = [
		'enumber','bloodtype','erelationship','econtact','nationality','civilstatus','occupation','allergyquestion', 'allergyname','past_disease','past_surgery','immunization','family_history','uid',
	];

	public function userInfo()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function doctors()
	{
		return $this->belongsToMany('App\Doctor', 'doctor_patient', 'patient_id', 'doctor_id');
	}

	public function consultations()
	{
		return $this->hasMany('App\MedicalHistory', 'patient_id');
	}

	public function prescriptions()
	{
		return $this->hasMany('App\Prescription', 'patient_id');
	}

	public static function doctorOfPatient($doctorId)
	{
		return DB::table('doctor_patient')
			   ->where('patient_id', EMedHelper::getPatientId(session('user_id')))
			   ->where('doctor_id', $doctorId)
			   ->first();
	}
	
}
