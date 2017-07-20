<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Permissions;
use App\UserRoles;
use App\TransactionLine;
use App\Common;
use App\Pharma;
use App\PharmacyManager;
use Auth;

use Log, Session;
use EMedUtil, EMedHelper;

class PharmaTransactionController extends Controller
{
    /**
     *  Sets the middleware which checks the permissions of each URL request
     *
     */
    public function __construct()
    {
        $this->middleware(['auth', 'requirechangepass']);
        $this->middleware('permissions', ['except' => ['storeTransaction', 'index', 'voidTransaction']]);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(in_array(session('user_type'),['PMANAGER', 'PHARMA']))
        {
            $patients = Common::getPatientsWithActivePrescriptions();
            $doctors = Common::getDoctorsWithActivePrescriptions();
            $patientDoctor = Common::getPatientDoctorLink();
            $prescriptions = Common::getActivePrescriptions();


            $data = EMedHelper::handlePatientPrescriptionsDisplay($patients, $doctors, $patientDoctor, $prescriptions);

           

            return view('transactions.list', ['items' => $data]);
        }
        else
        {
            abort(503);
        }
            
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

        //dd($data);
        $transactionData = array('pharma_id' => $data['pharmaId'], 'quantity' => $data['quantity'], 'prescription_id' => $data['prescriptionId']);

        $transaction = TransactionLine::create($transactionData);

        return json_encode(['message' => 'Successfully stored.']);
    }

    public function transactionList()
    {

        $userId = session('user_id');
        
        if(session('user_type') === 'PMANAGER')
        {
            $userData = PharmacyManager::getManagerData($userId);
            $mgrList = []; 
        }
        elseif(session('user_type') === 'PHARMA')
        {
          
            $userData = Pharma::getPharmaData($userId);
            $mgrList = PharmacyManager::getManagerData();

            $mgrList = EMedUtil::formatManagerList($mgrList);

        }
        else
        {
            abort(503);
        }

        $data = TransactionLine::getTransactionsOf($userData->drugstore, $userData->drugstore_branch);

      
        // Log::info(json_decode(json_encode($data), true));
        return view('transactions.transaction-list', ['items' => $data, 'userdata' => $userData, 'mgrList' => $mgrList]);
    }

    public function voidTransaction(Request $request)
    {
        $data = ['success' => true, 'message' => ''];
        $mgruser_id = session('user_id');

        if(!is_null($request->approvingMgr) && session('user_type') !== 'PMANAGER')
        {
            $mgruser_id = $request->approvingMgr;
            $passwordMatched = EMedHelper::isCurrentPassword($request->mgrPassword, $mgruser_id);
        }
        else
        {
            $passwordMatched = true;
        }

        if($passwordMatched)
        {
            TransactionLine::voidTransaction($request->transactionId, session('user_id'));
        }
        else
        {
            $data['success'] = false;
            $data['message'] = 'The manager password do not match with what is recorded in the system.';
        }
        

        return json_encode($data);
    }

}
