<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DoctorRequest;
use Validator;
use App\Doctor;
use App\User;
use App\Patient;
use Auth;
use App\Prescription;
use App\Common;
use Log;

class PrescriptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        Log::infO($request);   
        $prescriptions = Common::retrievePrescriptions($request->patient_id, $request->consultation_id);
        Log::infO($prescriptions);   

        return view('prescription.prescriptions', ['prescriptions' => $prescriptions]);
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

        $rules = [
            'patient_id' => 'required',
            'consultation_id' => 'required',
            'genericname' => 'required',
            'brand' => 'present|different:genericname',
            'quantity' => 'required|numeric|min:1',
            'duration' => 'required',
            'dosage' => 'required',
            'weight_type' => 'required',
            'frequency' => 'required',
            'start' => 'required|date_format:"Y-m-d"|after:today',
            'end' => 'required|date_format:"Y-m-d"',
            'notes' => 'present'
        ];

        $this->validate($request, $rules, [
            'start.date_format' => 'The start date must be of format MM/DD/YYYY',
            'start.after' => 'The start date is already expired',
            'end.date_format' => 'The end date must be of format MM/DD/YYYY'
        ]);

        $data = $request->only(array_keys($rules));

        Auth::user()->doctor->prescriptions()->create($data); 

        return redirect()->back()->with('ACTION_RESULT', [
                'type' => 'success', 
                'message' => 'New prescription has been saved successfully!'
            ]);;

        // return redirect()
        //     ->intended(route('patients.show', ['id' => $data['patient_id']]))
        //     ->with('ACTION_RESULT', [
        //         'type' => 'success', 
        //         'message' => 'New prescription has been saved successfully!'
        //     ]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Prescription::destroy($id);
        return redirect()->back();   
    }
}
