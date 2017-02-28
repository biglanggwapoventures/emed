<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MedicalHistory extends Model
{
    protected $fillable = [
		'chiefcomplaints','weight','height','bloodpressure','temperature','pulserate','resprate','medications','notes','prescription','allergyname','allergyquestion','pastsakit','immunization','surgeryprocedure'
	];

	public function userInfo()
	{
		return $this->belongsTo('App\User', 'user_id');
	}
}
