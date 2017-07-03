<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Common;

class CommonController extends Controller
{
    public function rfidAccess($uid)
    {
        // This is the patient UID
        $uId = $uid;
        $patientData = Common::getPatientDataByUID($uId);

        switch (session('user_type')) 
        {
            case 'ADMIN':
            case 'PMANAGER':
            case 'PATIENT':
                # DO_NOTHING
                break;

            case 'PHARMA':
                if($patientData->exists)
                {
                    return redirect('pharmatransaction/' . $patientData->id);
                }

                break;

            case 'DOCTOR':
            case 'SECRETARY':
            default:
                if($patientData->exists)
                {
                    return redirect('patients/' . $patientData->id);
                }
                else
                {
                    return view('patients.patient-form', ['predefinedUId' => $uId]);
                }

                break;
        }

        abort(404);
    }
}
