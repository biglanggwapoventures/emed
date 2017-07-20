<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class Pharma extends Model
{
      protected $fillable = [
		'drugstore','drugstore_branch','license', 'user_id'
	];

	public function userInfo()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public function manager()
	{
		return $this->belongsTo('App\PharmacyManager', 'manager_id');
	}

	public static function getPharmaData($user_id)
	{
		
		return DB::table('pharmas')
			   ->join('pharmacies', 'pharmas.drugstore', '=', 'pharmacies.id')
			   ->join('pharmacy_branches', 'pharmas.drugstore_branch', '=', 'pharmacy_branches.id')
			   ->select('pharmas.*', 'pharmacies.name AS pharmacy', 'pharmacy_branches.name AS pharmacyBranch', 'pharmacy_branches.address AS pharmacyBranchAddress')
			   ->where('pharmas.user_id', $user_id)->first();
	}
}

