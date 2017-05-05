<?php

namespace App;

use DB;

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

    public static function retrieveAllPharmas()
    {
        $data = DB::table('users')
                ->join('pharmas', 'users.id', '=', 'pharmas.user_id')
                ->join('users AS manager', 'pharmas.manager_id', '=', 'manager.id')
                ->select('users.*', 'pharmas.drugstore', 'pharmas.license', 'pharmas.manager_id', 'manager.lastname AS mgr_lastname', 'manager.firstname AS mgr_firstname')
                ->where('users.user_type', 'PHARMA')
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
                $dataItem = ['id' => $item->id, 'drugstore' => $item->drugstore, 'license' => $item->license, 'manager_id' => $item->manager_id, 'mgr_lastname' => $item->mgr_lastname, 'mgr_firstname' => $item->mgr_firstname, 'userInfo' => [
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
}
