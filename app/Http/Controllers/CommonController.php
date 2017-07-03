<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common;
use Auth;
use Log, EMedHelper;

class CommonController extends Controller
{
    public function rfidAccess($uid)
    {
        // This is the patient UID
        $uId = $uid;


        $patientData = Common::getPatientDataByUID($uId);

       
        switch (Auth::user()->user_type) 
        {
            case 'ADMIN':
            case 'PMANAGER':
            case 'PATIENT':
                # DO_NOTHING
                break;

            case 'PHARMA':
                if($patientData->exists)
                {
                    return redirect('pharmatransaction/' . $patientData->data->id);
                }

                break;

            case 'DOCTOR':
            {
               if($patientData->exists)
                {
                    return redirect('patients/' . $patientData->data->id);
                }
            }
            case 'SECRETARY':
            default:
                if($patientData->exists)
                {
                    return redirect('patients/' . $patientData->data->id);
                }
                else
                {
                    return view('patients.patient-form', ['predefinedUId' => $uId]);
                }

                break;
        }

                abort(503);
    }
}
