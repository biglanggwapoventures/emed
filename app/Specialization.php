<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $fillable = [
		'specialization'
	];

	public function subspecialization()
	{
		return $this->hasMany('App\SubSpecialization', 'specialization_id');
	}
}
