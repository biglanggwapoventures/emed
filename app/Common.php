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
}
