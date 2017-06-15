<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DoctorRequest;
use Validator;
use App\Doctor;
use App\User;
use App\Patient;
use App\MedicalHistory;
use App\ConsultationHistory;
use Auth;

use Log, EMedHelper;

class MedicalHistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('consultations.patient-notes');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        $patientId = $request->input('patient_id');

        $rules = [
            'weight' => 'required|numeric',
            'height' => 'required|numeric',
            'bloodpressure' => 'required',
            'temperature' => 'required|numeric',
            'pulserate' => 'present',
            'resprate' => 'present',
            // 'allergyquestion' => 'required|in:Y,N',
            // 'allergyname' => 'present|required_if:allergyquestion,Y',
            // 'pastsakit' => 'present',
            // 'immunization' => 'present',
            // 'surgeryprocedure' => 'present',
            'notes' => 'required',
            'chiefcomplaints' => 'required',
            'updatereason' => 'nullable'
            // ,            
            // 'medications' => 'required'
        ];

        $this->validate($request, $rules);


        $data = $request->only(array_keys($rules));
        $data['patient_id'] = $patientId;


        Auth::user()->doctor->consultations()->create($data); 

        return redirect()
            ->intended(route('patients.show', ['id' => $patientId]))
            ->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'New consultation has been saved successfully!'
            ]);
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $consultation = MedicalHistory::find($id);
        return view('consultations.edit', [
            'consultation' => $consultation
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(is_null($request->updatereason) || trim($request->updatereason) == '')
        {
            return redirect()
                ->intended(route('patients.edit', ['id' => $consultation->patient->id]))
                ->with('ACTION_RESULT', [
                    'type' => 'error', 
                    'message' => 'Update reason is required!'
                ]);
        }
        else
        {
            $consultation = MedicalHistory::find($id);

            $consultation_archive = array(
                'weight' => $consultation->weight,
                'height' => $consultation->height,
                'bloodpressure' => $consultation->bloodpressure,
                'temperature' => $consultation->temperature,
                'pulserate' => $consultation->pulserate,
                'resprate' => $consultation->resprate,
                'chiefcomplaints' => $consultation->chiefcomplaints,
                'notes' => $consultation->notes,
                'id' => $consultation->id,
                'updated_at' => date("Y-m-d H:i:s"),
                'patient_id' => $consultation->patient_id,
                'doctor_id' => $consultation->doctor_id,
                'update_id' => session('user_id'),
                'updatereason' => $request->updatereason
            );
            ConsultationHistory::addHistory($consultation_archive);

            $consultation_data = [
                'weight' => $request->weight,
                'height' => $request->height,
                'bloodpressure' => $request->bloodpressure,
                'temperature' => $request->temperature,
                'pulserate' => $request->pulserate,
                'resprate' => $request->resprate,
                'chiefcomplaints' => $request->chiefcomplaints,
                'notes' => $request->notes
            ];

            $consultation->fill($consultation_data);
            $consultation->save();

            return redirect()
                ->intended(route('patients.show', ['id' => $consultation->patient->id]))
                ->with('ACTION_RESULT', [
                    'type' => 'success', 
                    'message' => 'Consultation was edited successfully!'
                ]);
        }
            
    }

    public static function listConsultationHist($consultationId)
    {
        $current = ConsultationHistory::getCurrent($consultationId);
      
        $data = ConsultationHistory::getChangeLog($consultationId);
        // Log::info($data);
        if($data->isNotEmpty()){
         $firstItem = json_decode(json_encode($data), true)[0];
        }

        // $firstItem =(json_decode(json_encode($data), true));
        // dd($firstItem);
         if(!empty($firstItem)){
            $patientName = EMedHelper::retrievePatientName($firstItem['patient_id']);
            $doctorName = EMedHelper::retrieveDoctorName($firstItem['doctor_id']);    
         }else{
            $patientName = EMedHelper::retrievePatientName($current->patient_id);
            $doctorName  = EMedHelper::retrieveDoctorName($current->doctor_id);
         }
        

        return view('consultations.history', ['current' => $current, 'items' => $data, 'patient' => $patientName, 'doctor' => $doctorName]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        MedicalHistory::destroy($id);
        return redirect()->back();
    }
}
