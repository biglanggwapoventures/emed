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
}
