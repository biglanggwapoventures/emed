<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubSpecialization extends Model
{
	protected $fillable = [
		 'specialization_id', 'sub_specialization'
	];

	public function specialization()
	{
		return $this->belongsTo('App\Specialization', 'specialization_id');
	}

}
