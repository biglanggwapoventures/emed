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
}
