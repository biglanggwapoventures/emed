<?php

namespace App;

// use Illuminate\Database\Eloquent\Model;
use DB;
use Log;

class ConsultationHistory
{
    public static function addHistory($consultationData)
    {
    	$lastSeq = self::getLastSeqOf($consultationData['id']);
    	$consultationData['seq'] = $lastSeq;

    	DB::table('consultation_history')->insert($consultationData);
    }

    public static function getLastSeqOf($consultationId)
    {
    	$data = DB::table('consultation_history')->where('id', $consultationId)->orderBy('seq', 'DESC')->first(); 
    	return is_null($data) || empty($data) || count($data) <= 0 ? 1 : $data->seq+1;
    }

    public static function getCurrent($consultationId)
    {
        return DB::table('medical_histories')
               ->select('patient_id', 'doctor_id', 'weight', 'height', 'bloodpressure', 'temperature', 'pulserate', 'resprate', 'notes', 'chiefcomplaints', DB::raw("'' as updatereason"), 'updated_at')
               ->where('id', $consultationId)->first();
    }

    public static function getChangeLog($consultationId)
    {
    	// $current = DB::table('medical_histories')
    	// 		   ->select('patient_id', 'doctor_id', 'weight', 'height', 'bloodpressure', 'temperature', 'pulserate', 'resprate', 'notes', 'chiefcomplaints', DB::raw("'' as updatereason"), 'updated_at')
    	// 		   ->where('id', $consultationId);
    	$data = DB::table('consultation_history')
    			->select('patient_id', 'doctor_id', 'weight', 'height', 'bloodpressure', 'temperature', 'pulserate', 'resprate', 'notes', 'chiefcomplaints', 'updatereason', 'updated_at')
    			->where('id', $consultationId)//->union($current)
    			->orderBy('updated_at', 'DESC')
    			->get();

        // $history = DB::table('consultation_history')
        //            ->select('patient_id', 'doctor_id', 'weight', 'height', 'bloodpressure', 'temperature', 'pulserate', 'resprate', 'notes', 'chiefcomplaints', DB::raw("'' as updatereason"), 'updated_at')
        //            ->where('id', $consultationId);
        // $data = DB::table('consultation_history')
        //         ->select('patient_id', 'doctor_id', 'weight', 'height', 'bloodpressure', 'temperature', 'pulserate', 'resprate', 'notes', 'chiefcomplaints', 'updatereason', 'updated_at')
        //         ->where('id', $consultationId)->union($current)
        //         ->orderBy('updated_at', 'DESC')
        //         ->get();

    	return $data;
    }
}