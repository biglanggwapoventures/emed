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
		return DB::table('pharmacy_managers')
			   ->join('pharmacies', 'pharmacy_managers.drugstore', '=', 'pharmacies.id')
			   ->join('pharmacy_branches', 'pharmacy_managers.drugstore_branch', '=', 'pharmacy_branches.id')
			   ->select('pharmacy_managers.*', 'pharmacies.name AS pharmacy', 'pharmacy_branches.name AS pharmacyBranch', 'pharmacy_branches.address AS pharmacyBranchAddress')
			   ->where('pharmacy_managers.user_id', $user_id)->first();
	}
}
