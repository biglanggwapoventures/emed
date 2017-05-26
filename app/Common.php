<?php

namespace App;

use DB;
use Hash, Log;

class Common
{
    public static function retrievePrescriptions($patientId, $consultationId)
    {
        return DB::table('prescriptions')
               ->where('patient_id', $patientId)
               ->where('consultation_id', $consultationId)
               ->get();;
    }

    public static function retrieveValidPrescriptions($patientId)
    {
        return DB::table('prescriptions')
               ->where('patient_id', $patientId)
               ->where('end', '>=', date('Y-m-d'))
               ->get();
    }

    public static function retrieveValidPrescriptionsPerConsultation($patientId, $consultationId)
    {
        return DB::table('prescriptions')
               ->where('patient_id', $patientId)
               ->where('consultation_id', $consultationId)
               ->where('end', '>=', date('Y-m-d'))
               ->get();
    }

    public static function retrieveAllUsers($userTypeCode)
    {
        $data = DB::table('users')
                ->where('user_type', $userTypeCode)
                ->get();

        if(is_null($data) || empty($data) || count($data) <= 0)
        {
            return $data;
        }
        else
        {
            $dataArray = [];
            foreach ($data as $item) 
            {
                $dataItem = ['id' => $item->id, 'userInfo' => [
                    'address'           => $item->address,
                    'avatar'            => $item->avatar,
                    'birthdate'         => $item->birthdate,
                    'contact_number'    => $item->contact_number,
                    'created_at'        => $item->created_at,
                    'email'             => $item->email,
                    'firstname'         => $item->firstname,
                    'id'                => $item->id,
                    'lastname'          => $item->lastname,
                    'middle_initial'    => $item->middle_initial,
                    'sex'               => $item->sex,
                    'updated_at'        => $item->updated_at,
                    'user_type'         => $item->user_type,
                    'user_type_id'      => $item->user_type_id,
                    'username'          => $item->username
                ]];

                array_push($dataArray, $dataItem);
            }

            return json_decode(json_encode($dataArray));
        }
    }

    public static function retrieveAttachedPatientsAndFloating($doctorId)
    {
        $data = DB::table('users')
                ->join('patients', 'users.id', '=', 'patients.user_id')
                ->select('users.*', 'patients.id AS patient_id')
                ->where('users.user_type', 'PATIENT')
                ->whereRaw(DB::raw('(patients.id IN (SELECT patient_id FROM doctor_patient WHERE doctor_id = ' . $doctorId . ') OR patients.id NOT IN (SELECT patient_id FROM doctor_patient))'))
                ->get();

        if(is_null($data) || empty($data) || count($data) <= 0)
        {
            return $data;
        }
        else
        {
            $dataArray = [];
            foreach ($data as $item) 
            {
                $dataItem = ['id' => $item->patient_id, 'userInfo' => [
                    'address'           => $item->address,
                    'avatar'            => $item->avatar,
                    'birthdate'         => $item->birthdate,
                    'contact_number'    => $item->contact_number,
                    'created_at'        => $item->created_at,
                    'email'             => $item->email,
                    'firstname'         => $item->firstname,
                    'id'                => $item->id,
                    'lastname'          => $item->lastname,
                    'middle_initial'    => $item->middle_initial,
                    'sex'               => $item->sex,
                    'updated_at'        => $item->updated_at,
                    'user_type'         => $item->user_type,
                    'user_type_id'      => $item->user_type_id,
                    'username'          => $item->username
                ]];

                array_push($dataArray, $dataItem);
            }

            return json_decode(json_encode($dataArray));
        }
    }

    public static function retrieveUsersOfCurrentUser($userTypeCode)
    {
        $data = DB::table('users')
                ->where('user_type', $userTypeCode)
                ->where('added_by', session('user_id'))
                ->get();

        if(is_null($data) || empty($data) || count($data) <= 0)
        {
            return $data;
        }
        else
        {
            $dataArray = [];
            foreach ($data as $item) 
            {
                $dataItem = ['id' => $item->id, 'userInfo' => [
                    'address'           => $item->address,
                    'avatar'            => $item->avatar,
                    'birthdate'         => $item->birthdate,
                    'contact_number'    => $item->contact_number,
                    'created_at'        => $item->created_at,
                    'email'             => $item->email,
                    'firstname'         => $item->firstname,
                    'id'                => $item->id,
                    'lastname'          => $item->lastname,
                    'middle_initial'    => $item->middle_initial,
                    'sex'               => $item->sex,
                    'updated_at'        => $item->updated_at,
                    'user_type'         => $item->user_type,
                    'user_type_id'      => $item->user_type_id,
                    'username'          => $item->username
                ]];

                array_push($dataArray, $dataItem);
            }

            return json_decode(json_encode($dataArray));
        }
    }

    public static function retrieveAllPharmas($pharmacyId = null, $branchId = null, $managerId = null)
    {
        $wQuery = "users.user_type = 'PHARMA'";
        
        if(!is_null($pharmacyId))
        {
            $wQuery .= " AND pharmas.drugstore = " . $pharmacyId;
        }

        if(!is_null($branchId))
        {
            $wQuery .= " AND pharmas.drugstore_branch = " . $branchId;
        }

        if(!is_null($managerId))
        {
            $wQuery .= " AND pharmas.manager_id = " . $managerId;
        }

        $data = DB::table('users')
                ->whereRaw($wQuery)
                ->join('pharmas', 'users.id', '=', 'pharmas.user_id')
                ->join('pharmacies', 'pharmas.drugstore', '=', 'pharmacies.id')
                ->join('pharmacy_branches', 'pharmas.drugstore_branch', '=', 'pharmacy_branches.id')
                // ->join('users AS manager', 'pharmas.manager_id', '=', 'pharmacy_managers.id')
                ->select(DB::raw("users.*, pharmacies.name as drugstore, pharmas.license, pharmas.manager_id, (SELECT CONCAT(firstname, ' ', lastname) FROM users JOIN pharmacy_managers ON (users.id = pharmacy_managers.user_id) WHERE pharmacy_managers.id = pharmas.manager_id) AS mgr"))
                ->get();

        if(is_null($data) || empty($data) || count($data) <= 0)
        {
            return $data;
        }
        else
        {
            $dataArray = [];
            foreach ($data as $item) 
            {
                $dataItem = ['id' => $item->id, 'drugstore' => $item->drugstore, 'license' => $item->license, 'manager_id' => $item->manager_id, 'mgr' => $item->mgr, 'userInfo' => [
                    'address'           => $item->address,
                    'avatar'            => $item->avatar,
                    'birthdate'         => $item->birthdate,
                    'contact_number'    => $item->contact_number,
                    'created_at'        => $item->created_at,
                    'email'             => $item->email,
                    'firstname'         => $item->firstname,
                    'id'                => $item->id,
                    'lastname'          => $item->lastname,
                    'middle_initial'    => $item->middle_initial,
                    'sex'               => $item->sex,
                    'updated_at'        => $item->updated_at,
                    'user_type'         => $item->user_type,
                    'user_type_id'      => $item->user_type_id,
                    'username'          => $item->username
                ]];

                array_push($dataArray, $dataItem);
            }

            return json_decode(json_encode($dataArray));
        }
    }

    public static function getDoctorAttachments($patientId)
    {
        return DB::table('doctor_patient')->where('patient_id', $patientId)->get();
    }

    public static function getDoctorId($doctorUserId)
    {
        return DB::table('doctors')->select('id')->where('user_id', $doctorUserId)->first()->id;
    }

    public static function getAffiliation($affiliationId)
    {
        return DB::table('affiliations')->where('id', $affiliationId)->first();
    }

    public static function getAffiliationBranch($branchId)
    {
        return DB::table('affiliation_branches')->where('id', $branchId)->first();
    }

    public static function getPharmacy($pharmacyId)
    {
        return DB::table('pharmacies')->where('id', $pharmacyId)->first();
    }

    public static function getPharmacyBranch($branchId)
    {
        return DB::table('pharmacy_branches')->where('id', $branchId)->first();
    }

    public static function getPatientsWithActivePrescriptions()
    {
        return DB::table('patients')
               ->join('users', 'patients.user_id', '=', 'users.id')
               ->select('patients.id AS patient_id', 'users.*')
               ->whereRaw(DB::raw('patients.id IN (SELECT patient_id FROM prescriptions WHERE prescriptions.end >= NOW())'))
               ->get();
    }

    public static function getDoctorsWithActivePrescriptions()
    {
        return DB::table('doctors')
               ->join('users', 'doctors.user_id', '=', 'users.id')
               ->select('doctors.id AS doctor_id', 'users.*')
               ->whereRaw(DB::raw('doctors.id IN (SELECT doctor_id FROM prescriptions WHERE prescriptions.end >= NOW())'))
               ->get();
    }

    public static function getActivePrescriptions($patientId = null, $doctorId = null)
    {
        $clause = 'prescriptions.end >= NOW()';
        if(!is_null($patientId))
        {
            $clause .= ' AND patient_id = ' . $patientId;
        }

        if(!is_null($doctorId))
        {
            $clause .= ' AND doctor_id = ' . $doctorId;
        }

        return DB::table('prescriptions')
               ->whereRaw(DB::raw($clause))
               ->get();
    }

    public static function getPatientDoctorLink($patientId = null)
    {
        if(is_null($patientId))
        {
            return DB::table('doctor_patient')->get();
        }
        else
        {
            return DB::table('doctor_patient')->where('patient_id', $patientId)->get();
        }
            
    }

    public static function getPatientUserData($patientId)
    {
        return DB::table('users')
               ->join('patients', 'users.id', '=', 'patients.user_id')
               ->select('users.*')
               ->where('patients.id', $patientId)
               ->first();
    }

    public static function getPatientData($patientId)
    {
        return DB::table('patients')
               ->where('id', $patientId)
               ->first();
    }

    public static function getDoctorUserData($doctorId)
    {
        return DB::table('users')
               ->join('doctors', 'users.id', '=', 'doctors.user_id')
               ->select('users.*')
               ->where('doctors.id', $doctorId)
               ->first();
    }

    public static function getDoctorData($doctorId)
    {
        return DB::table('doctors')
               ->where('id', $doctorId)
               ->first();
    }

    public static function doPasswordsMatch($userId, $rawPassword)
    {
        $data = DB::table('users')->where('id', $userId)->first();
        $encryptedPassword = $data->password;

        
    }
}
