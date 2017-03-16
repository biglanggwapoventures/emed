<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DoctorRequest;
use Validator;
use App\Doctor;
use App\User;
use App\Patient;
use Auth;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showHomepage()
    {

        $docs = Auth::user()->doctor;
        // dd($items);
        return view('doctors.doctor-home', [
            'docs' => $docs
        ]);

           
    }

    public function index()
    {
        $items = Doctor::with('userInfo')->get();
        // dd($items);
        return view('doctors.list', [
            'items' => $items
        ]);
    }

    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('doctors.doctor-form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorRequest $request)
    {
        // get fields for user table
        $input = $request->only([
            'username', 
            'firstname', 
            'lastname',
            'middle_initial',
            'contact_number',
            'birthdate',
            'sex',
            'email',
            'address'
        ]);
        // verify if username exists
        $credentials = $request->only(['username']);


        // assign password: default is firstname+lastname lowercase
        $input['password'] = bcrypt(strtolower($input['firstname']).strtolower($input['lastname']));
        // assign user type
        $input['user_type'] = 'DOCTOR';
        //save to DB (users)
        $user = User::create($input);

        // save to DB (doctors)       
        $user->doctor()->create([
            'specialization' => $request->specialization,
            'clinic' => $request->clinic,
            'clinic_address'=> $request->clinic_address,
            'clinic_hours' => $request->clinic_hours,
            'ptr' => $request->ptr,
            'prc' => $request->prc,
            's2' => $request->s2,
            'title' => $request->title,
            'subspecialty' => $request->subspecialty,
            'affiliations' => $request->affiliations,
            'med_school' => $request->med_school,
            'med_school_year' => $request->med_school_year,
            'residency' => $request->residency,
            'residency_year' => $request->residency_year,
            'training' => $request->training,
            'training_year' => $request->training_year,

        ]);

       // $user ['subspecialty'] = json_encode($input['subspecialty']);
       return redirect()->route('admin.index');
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
            return view('doctors.edit', [
            'data' => Doctor::with('userInfo')->where('user_id', $id)->first()
        ]);
      }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorRequest $request, $id)
    {
        // get fields for user table
        // dd($request->all());

        $doctor = Doctor::find($id);
        $doctor->fill([
            'specialization' => $request->specialization,
            'title' => $request->title,
            'clinic' => $request->clinic,
            'clinic_address'=> $request->clinic_address,
            'clinic_hours' => $request->clinic_hours,
            'prc' => $request->prc,
            'ptr' => $request->ptr,
            's2' => $request->s2,
            'subspecialty' => $request->input('subspecialty'),
            'affiliations' => $request->input('affiliations')
        ]);

        $doctor->save();

        $user = User::find($doctor->user_id);
        $user->fill($request->only([
            'firstname', 
            'middle_initial',
            'lastname',
            'birthdate',
            'sex',
            'contact_number',
            'address',
            'username', 
            'email',
        ]));
        $user->save();
        
        // $docs = Auth::user()->doctor;
        if(Auth::user()->user_type === "DOCTOR")
            return redirect('/doctor-home');
        else 
            return redirect()->route('admin.index');
}
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // User::de($id)->delete();
        // return redirect()->route('doctors.index');
    }
}
