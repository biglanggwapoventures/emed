<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class CustomUser extends Model
{
	protected $fillable = [
		'enumber',
		'bloodtype',
		'erelationship',
		'econtact',
		'nationality',
		'civilstatus',
		'occupation'
	];

	// protected $table = 'custom_users';


	public function userInfo()
	{
		return $this->belongsTo('App\User', 'user_id');
	}

	public static function retrieveCustomUserId($userId)
	{
		return DB::table('custom_users')->select('id')->where('user_id', $userId)->first()->id;
	}

	public static function getData($user_id)
    {
        return DB::table('users')->where('id', $user_id)->first();
    }

    public static function retrieveData($id)
    {
        return DB::table('users')
               ->join('custom_users', 'users.id', '=', 'custom_users.user_id')
               ->select(DB::raw("CONCAT(users.firstname,' ',users.middle_initial,'. ',users.lastname) AS fullname"), "users.*", "custom_users.bloodtype", "custom_users.econtact", "custom_users.enumber", "custom_users.nationality",
                        "custom_users.civilstatus", "custom_users.erelationship", "custom_users.occupation", "custom_users.uid")
               ->where('users.id', $id)->first();
    }

    public static function storeData($customData)
    {
        DB::table('custom_users')->insert($customData);
    }

    public static function retrieveRoleList($role, $addedBy = null)
    {
        $where = "users.user_type = '" . $role . "'";
        if(!is_null($addedBy))
        {
            $where .= " AND users.added_by = " . $addedBy;
        }

        return DB::table('users')
               ->join('custom_users', 'users.id', '=', 'custom_users.user_id')
               ->select(DB::raw("CONCAT(users.firstname,' ',users.middle_initial,'. ',users.lastname) AS fullname"), "users.*", "custom_users.bloodtype", "custom_users.econtact", "custom_users.enumber", "custom_users.nationality",
                        "custom_users.civilstatus", "custom_users.erelationship", "custom_users.occupation", "custom_users.uid")
               ->whereRaw(DB::raw($where))->get();
    }

	// public function doctors()
	// {
	// 	return $this->belongsToMany('App\Doctor', 'doctor_patient', 'patient_id', 'doctor_id');
	// }

	// public function consultations()
	// {
	// 	return $this->hasMany('App\MedicalHistory', 'patient_id');
	// }

	// public function prescriptions()
	// {
	// 	return $this->hasMany('App\Prescription', 'patient_id');
	// }

	// public function lackingPrescriptions()
	// {
	// 	return $this->prescriptions()
			
	// }
	
}
