<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

use Log;

class TransactionLine extends Model
{
    protected $fillable = [
        'pharma_id',
        'prescription_id',
        'quantity'
    ];

    protected $casts = [
        'voided' => 'boolean'
    ];

    protected $table = 'transaction_lines';


    public static function getPurcQtyOfPrescription($id)
    {
        $qty = 0;
        $data = DB::table('transaction_lines')
                ->select(DB::raw('COALESCE(SUM(quantity), 0) AS PurchasedQty'))
                ->where('prescription_id', $id)
                ->where('voided', 0)
                ->first();

        if(count($data) > 0)
        {
            $qty = $data->PurchasedQty;
        }

        return $qty;
    }

    public static function getTransactionsOf($pharmacyId, $branchId)
    {
        return DB::table('transaction_lines')
               ->join('pharmas', 'transaction_lines.pharma_id', '=', 'pharmas.id')
               ->join('users AS pharma', 'pharmas.user_id', '=', 'pharma.id')
               ->join('prescriptions', 'transaction_lines.prescription_id', '=', 'prescriptions.id')
               ->join('patients', 'prescriptions.patient_id', '=', 'patients.id')
               ->join('users AS patient', 'patients.user_id', '=', 'patient.id')
               ->join('doctors', 'prescriptions.doctor_id', '=', 'doctors.id')
               ->join('users AS doctor', 'doctors.user_id', '=', 'doctor.id')
               ->select(DB::raw("CONCAT(patient.firstname, ' ', patient.lastname) AS patientName, CONCAT(doctor.firstname, ' ', doctor.lastname) AS doctorName, CONCAT(pharma.firstname, ' ', pharma.lastname) AS pharmaName, transaction_lines.id AS transId, transaction_lines.pharma_id, transaction_lines.quantity AS purchaseQty, transaction_lines.voided, transaction_lines.manager_id, transaction_lines.created_at AS purchaseTimestamp, prescriptions.*"))
               ->where('pharmas.drugstore', $pharmacyId)
               ->where('pharmas.drugstore_branch', $branchId)
               ->orderBy('purchaseTimestamp', 'DESC')
               ->get();
    }

    public static function voidTransaction($transactionId, $managerId)
    {

        DB::table('transaction_lines')  
        ->where('id', $transactionId)
        ->update(array('voided' => 1, 'manager_id' => $managerId));
    }
}
