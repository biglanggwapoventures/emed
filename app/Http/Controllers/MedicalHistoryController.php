<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DoctorRequest;
use Validator;
use App\Doctor;
use App\User;
use App\Patient;
use Auth;

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
       $user = User::create($input);

        // save to DB (doctors)       
        $user->patient()->create([
            'weight' => $request->weight,
            'height' => $request->height,
            'bloodpressure'=> $request->bloodpressure,
            'temperature' => $request->temperature,
            'pulserate' => $request->pulserate,
            'resprate' => $request->resprate,
            'patientnote' => $request->patientnote,
            'allergyname' => $request->allergyname,
            'allergyquestion' => $request->allergyquestion,
            'pastsakit' => $request->pastsakit,
            'immunization' => $request->immunization,
            'surgeryprocedure' => $request->surgeryprocedure,
            'notes' => $request->notes,
            'chiefcomplaints' => $request->chiefcomplaints,
            'medications' => $request->medications

        ]);

       // $user ['subspecialty'] = json_encode($input['subspecialty']);
       return redirect()->route('patients.index');
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
        //
    }
}
