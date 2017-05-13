<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Permissions;
use App\UserRoles;
use App\TransactionLine;
use App\Common;
use Log, Session, EMedHelper;

class PharmaTransactionController extends Controller
{
    /**
     *  Sets the middleware which checks the permissions of each URL request
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('permissions', ['except' => ['store', 'update', 'showHomepage']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $patients = Common::getPatientsWithActivePrescriptions();
        $doctors = Common::getDoctorsWithActivePrescriptions();
        $patientDoctor = Common::getPatientDoctorLink();
        $prescriptions = Common::getActivePrescriptions();

        $data = EMedHelper::handlePatientPrescriptionsDisplay($patients, $doctors, $patientDoctor, $prescriptions);

        return view('transactions.list', ['items' => $data]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function transaction($patientId)
    {
        $patientUserData = Common::getPatientUserData($patientId);

        if(is_null($patientUserData))
        {
            $msg = 'DATA NOT FOUND. Patient user data cannot be found.';

            Session::flash('503_msg', $msg);
            Log::error($msg);

            abort(503);
        }
        else
        {
            $name = $patientUserData->firstname . " " . $patientUserData->lastname;
            $items = EMedHelper::handlePatientPrescriptions($patientId);

            return view('transactions.patient-prescriptions', ['name' => $name, 'items' => $items]);
        }
    }

    public function storeTransaction(Request $request)
    {
        $data = $request->all();
        $transactionData = array('pharma_id' => $data['pharmaId'], 'quantity' => $data['quantity'], 'prescription_id' => $data['prescriptionId']);

        $transaction = TransactionLine::create($transactionData);

        return json_encode(['message' => 'Successfully stored.']);
    }
}
