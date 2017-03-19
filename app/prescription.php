<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Prescription extends Model
{
    protected $fillable = [
		'brand',
		'genericname',
		'quantity',
		'dosage',
		'frequency',
		'start',
		'end',
		'patient_id',
		'doctor_id',
		'consultation_id'
	];

	public function patient()
	{
		return $this->belongsTo('App\Patient', 'patient_id');
	}

	public function doctor()
	{
		return $this->belongsTo('App\Doctor', 'doctor_id');
	}

	public function consultation()
	{
		return $this->belongsTo('App\MedicalHistory', 'consultation_id');
	}
}
